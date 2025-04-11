<?php

namespace App\Service;

use APP\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TransactionRepository;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{

    protected $pricingRepository;
    protected $transactionRepository;

    public function __construct(
        PricingRepositoryInterface $pricingRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->pricingRepository = $pricingRepository;
        $this->transactionRepository = $transactionRepository;
    }
    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubscribed = $pricing->isSubscribedByUser($user->id);

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
        return $this->pricingRepository->findById($pricingId);
    }


    public function getUserTransaction()
    {
        $user = Auth::user();

        if (!$user) {
            return collect();
        }

        return $this->transactionRepository->getUserTransactions($user->id);

        // return Transaction::with('pricing')
        // ->where('user_id', $user->id)
        // ->ordering('created_at', 'desc')
        // ->get();
    }
}
