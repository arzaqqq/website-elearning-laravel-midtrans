<?php

namespace App\Observers;


use App\Models\Transaction;
use App\Helpers\TransactionHelper;

class TransactionObserver
{

    public function creating($transaction)
    {
        $transaction->booking_trx_id = TransactionHelper::generateUniqueTrxId();
    }

    public function created (Transaction $transaction):void
    {

    }
}
