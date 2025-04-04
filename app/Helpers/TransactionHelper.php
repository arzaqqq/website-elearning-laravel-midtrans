<?php

namespace App\Helpers;

use App\Models\Transaction;

class TransactionHelper
{
    /**
     * Generate a unique transaction ID with prefix
     *
     * @return string A unique transaction ID in the format 'FUTURCAMP' followed by random digits
     */
    public static function generateUniqueTrxId(): string
    {
        $prefix = 'FUTURCAMP';
        $maxAttempts = 100; 
        $attempts = 0;

        do {
            $randomNumber = mt_rand(1000, 9999);
            $transactionId = $prefix . $randomNumber;
            $attempts++;

            if ($attempts >= $maxAttempts) {
                throw new \RuntimeException('Failed to generate unique transaction ID after ' . $maxAttempts . ' attempts');
            }

        } while (Transaction::where('booking_trx_id', $transactionId)->exists());

        return $transactionId;
    }
}
