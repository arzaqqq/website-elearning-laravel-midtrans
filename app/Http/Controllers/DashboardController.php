<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class DashboardController extends Controller
{
    protected $transactionService;

    public function __construct(
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
    }

    public function subscriptions()
    {
        $transactions = $this->transactionService->getUserTransaction();
        return view ('front.subscrioptions', compact('transactions'));
    }

    public function subscription_details(Transaction $transaction)
    {
        return view('front.subscription_details', compact('transaction'));
    }
}
