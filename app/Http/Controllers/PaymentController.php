<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventOrganizerAssignment;
use App\Models\Event;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Transfer;

class PaymentController extends Controller
{
    public function payAssignment($id)
    {
        $assignment = EventOrganizerAssignment::with('event')->findOrFail($id);

        if ($assignment->payment_status == 'paid') {
            return back()->with('error', 'Payment already completed.');
        }

        $event = $assignment->event;

        // -------------------------------
        // 20% Advance Calculation
        // -------------------------------
        $advance = $event->event_budget * 0.20;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => env('STRIPE_CURRENCY', 'pkr'),
                    'product_data' => ['name' => "Advance Payment for {$event->event_name}"],
                    'unit_amount' => $advance * 100,
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),

            'metadata' => [
                'assignment_id' => $assignment->id
            ]
        ]);

        return redirect($session->url);
    }
    private $usdRate = 280; // 1 USD = 280 PKR

    private function toUSD($pkr)
    {
        return round($pkr / $this->usdRate, 2);
    }

public function success(Request $request)
    {
        $session_id = $request->session_id;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($session_id);

        $assignment_id = $session->metadata->assignment_id;
        $assignment = EventOrganizerAssignment::with(['event', 'organizer', 'client'])->find($assignment_id);

        $event = $assignment->event;
        $organizer = $assignment->organizer;
        $client = $assignment->client;

        // -----------------------------------
        // PKR CALCULATIONS
        // -----------------------------------
        $advance_pkr = $event->event_budget * 0.20;
        $commission_pkr = $advance_pkr * 0.02;
        $transferable_pkr = $advance_pkr - $commission_pkr;

        // Convert PKR → USD
        $advance_usd = $this->toUSD($advance_pkr);
        $commission_usd = $this->toUSD($commission_pkr);
        $transferable_usd = $this->toUSD($transferable_pkr);

        // -----------------------------------------
        // Transfer money to organizer via USD
        // -----------------------------------------
        $transfer = Transfer::create([
            'amount' => $transferable_usd * 100, // USD cents
            'currency' => 'usd',
            'destination' => $organizer->stripe_account_id,
            'transfer_group' => "assignment_" . $assignment_id,
        ]);

        // -----------------------------------------
        // Save Payment (store PKR + USD both)
        // -----------------------------------------
        Payment::create([
            'assignment_id' => $assignment->id,
            'assignment_type' => 1, // 1 = organizer assignment
            'id_from' => $client->id,
            'id_to' => $organizer->id,
            'event_id' => $event->event_id,

            // PKR values
            'total_amount' => $event->event_budget,
            'advance_amount' => $advance_pkr,
            'commission' => $commission_pkr,
            'amount_transferred' => $transferable_pkr,

            // Stripe values
            'payment_intent_id' => $session->payment_intent,
            'transfer_id' => $transfer->id,

            'paid_at' => now(),
            'released_at' => now(),
        ]);

        // Update assignment
        $assignment->update([
            'payment_status' => 'paid',
            'payment_intent_id' => $session->payment_intent,
            'payment_transaction_id' => $session->id,
            'payment_date' => now(),
            'payment_released' => true,
            'released_date' => now(),
        ]);

        sessionMsg('success', 'Payment completed successfully.', 'success');
        return redirect('/client-dashboard')->with('success', 'Payment completed successfully.');
    }
    public function cancel()
    {
        return redirect('/')->with('error', 'Payment cancelled.');
    }

}