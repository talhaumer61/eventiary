<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventVendorAssignment;
use App\Models\VendorService;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Transfer;

class VendorPaymentController extends Controller
{
    private $usdRate = 280; // PKR → USD conversion rate

    private function toUSD($pkr)
    {
        return round($pkr / $this->usdRate, 2);
    }

    // -----------------------------
    // 1) Create checkout session
    // -----------------------------
    public function payVendorAssignment($id)
    {
        $assignment = EventVendorAssignment::with(['service', 'vendor', 'client'])->findOrFail($id);

        if ($assignment->status != 1) { // must be accepted
            return back()->with('error', 'Vendor booking must be accepted first.');
        }

        // Service details
        $service = VendorService::find($assignment->service_id);
        $servicePrice = $service->service_price;

        // 20% advance
        $advance = $servicePrice * 0.20;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => [[
                'price_data' => [
                    'currency' => env('STRIPE_CURRENCY', 'pkr'),
                    'product_data' => [
                        'name' => "Advance Payment for {$service->service_name}"
                    ],
                    'unit_amount' => $advance * 100,
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',

            'success_url' => route('vendor.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('vendor.payment.cancel'),

            'metadata' => [
                'assignment_id' => $assignment->id
            ],
        ]);

        return redirect($session->url);
    }

    // -----------------------------
    // 2) Payment success → Transfer to Vendor
    // -----------------------------
    public function success(Request $request)
    {
        $session_id = $request->session_id;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::retrieve($session_id);

        $assignment_id = $session->metadata->assignment_id;

        $assignment = EventVendorAssignment::with(['service', 'vendor', 'client'])->find($assignment_id);

        $service = $assignment->service;
        $vendor = $assignment->vendor;
        $client = $assignment->client;

        // PKR calculations
        $advance_pkr = $service->service_price * 0.20;
        $commission_pkr = $advance_pkr * 0.02; // 2% admin fee
        $transferable_pkr = $advance_pkr - $commission_pkr;

        // USD conversion
        $advance_usd = $this->toUSD($advance_pkr);
        $commission_usd = $this->toUSD($commission_pkr);
        $transferable_usd = $this->toUSD($transferable_pkr);

        // Transfer to vendor
        $transfer = Transfer::create([
            'amount' => $transferable_usd * 100, // cents
            'currency' => 'usd',
            'destination' => $vendor->stripe_account_id,
            'transfer_group' => "vendor_assignment_" . $assignment_id
        ]);

        // Save payment record
        Payment::create([
            'assignment_id' => $assignment->id,
            'assignment_type' => 2, // 2 = vendor assignment
            'id_from' => $client->id,
            'id_to' => $vendor->id,
            'event_id' => $assignment->event_id,

            'total_amount' => $service->service_price,
            'advance_amount' => $advance_pkr,
            'commission' => $commission_pkr,
            'amount_transferred' => $transferable_pkr,

            'payment_intent_id' => $session->payment_intent,
            'transfer_id' => $transfer->id,

            'paid_at' => now(),
            'released_at' => now(),
        ]);

        // Update vendor assignment status (paid)
        $assignment->update([
            'payment_status' => 'paid', // You may add 4 = paid
        ]);

        sessionMsg('success', 'Vendor Advance Payment completed successfully!', 'success');
        if(Auth::user()->login_type == 3){
            return redirect('/organizer-dashboard')->with('success', 'Vendor Advance Payment completed successfully!');
        }
        else{
            return redirect('/client-dashboard')->with('success', 'Vendor Advance Payment completed successfully!');
        }
    }

    // -----------------------------
    // 3) Cancel
    // -----------------------------
    public function cancel()
    {
        return redirect('/client-dashboard')->with('error', 'Vendor payment cancelled.');
    }
}
