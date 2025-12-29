<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // <-- IMPORTANT
use Stripe\Stripe;
use Stripe\Account;

class StripeConnectController extends Controller
{
    public function connect()
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $user = Auth::user();

    if ($user->stripe_onboarded) {
        return redirect('/organizer-dashboard')
            ->with('info', 'Stripe already connected.');
    }

    if (!$user->stripe_account_id) {
        $account = Account::create([
            'type'  => 'express',
            'email' => $user->email,
        ]);

        $user->update([
            'stripe_account_id' => $account->id,
        ]);
    }

    $link = AccountLink::create([
        'account'     => $user->stripe_account_id,
        'refresh_url' => route('organizer.connect'),
        'return_url'  => route('organizer.connect.callback'),
        'type'        => 'account_onboarding',
    ]);

    return redirect($link->url);
}


    public function callback()
    {
        $user = Auth::user();

        $user->update([
            'stripe_onboarded' => true,
        ]);

        sessionMsg('success', 'Stripe account connected successfully.', 'success');

        return redirect('/organizer-dashboard')
            ->with('success', 'Stripe account connected successfully.');
    }

    // Vendor Stripe Connect
    public function vendorConnect()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = auth()->user();
        if (!$user) abort(403);

        // Create Express account
        $account = Account::create([
            'type' => 'express'
        ]);

        // Save in users table
        $user->update([
            'stripe_account_id' => $account->id
        ]);

        // Create onboarding link
        $link = \Stripe\AccountLink::create([
            'account' => $account->id,
            'refresh_url' => route('vendor.connect'),
            'return_url' => route('vendor.connect.callback'),
            'type' => 'account_onboarding',
        ]);

        return redirect($link->url);
    }

    public function vendorCallback()
    {
        auth()->user()->update([
            'stripe_onboarded' => true
        ]);

        sessionMsg('success', 'Stripe account connected successfully.', 'success');
        if (auth()->user()->login_type === 2) {
            return redirect('/organizer-dashboard');
        }
        else{
            return redirect('/vendor-dashboard')->with('success', 'Stripe account connected successfully.');
        }
    }
}
