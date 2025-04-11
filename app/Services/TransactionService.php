<?php

namespace App\Service;

use APP\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();

        // Check if user is already subscribed
        // $alreadySubscribed = $pricing->isSubscribedByUser($user->id);

        // Calculate amounts
        $taxRate = 0.11;
        $totalTaxAmount = $pricing->price * $taxRate;
        $subTotalAmount = $pricing->price;
        $grandTotalAmount = $subTotalAmount + $totalTaxAmount;

        // Calculate subscription dates
        $startedAt = now(); // Current date in user's timezone
        $endedAt = $startedAt->copy()->addMonths($pricing->duration);

        // Store pricing ID in session
        session()->put('pricing_id', $pricing->id);

        return [
            'total_tax_amount',
            'grand_total_amount' ,
            'sub_total_amount' ,
            'pricing',
            'user' ,
            'alreadySubscribed' ,
            'started_at' ,
            'ended_at'
        ];
    }

    public function getRecentPricing()
    {
        $pricingId = session()->get('pricing_id');
        return Pricing::find($pricingId);
    }


    public function getUserTransaction()
    {
        $user = Auth::user();

        if (!$user) {
            return collect();
        }

        return Transaction::with('pricing')
        ->where('user_id', $user->id)
        ->ordering('created_at', 'desc')
        ->get();
    }
}
