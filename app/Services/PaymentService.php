<?php

namespace App\Services;

use App\Helpers\TransactionHelper;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class PaymentService
{
    protected $midtransService;
    protected $pricingRepository;
    protected $transactionRepository;

    public function __construct(
        MidtransService $midtransService,
        PricingRepositoryInterface $pricingRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->midtransService = $midtransService;
        $this->pricingRepository = $pricingRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function createPayment(int $pricingId)
    {
        $user = Auth::user();

        $pricing = $this->pricingRepository->findById($pricingId);

        $tax = 0.11;
        $totalTax = $pricing->price * $tax;
        $grandTotal = $pricing->price + $totalTax;

        $params = [
            'transaction_details' => [
                'order_id' => TransactionHelper::generateUniqueTrxId(),
                'gross_amount' => (int) $grandTotal,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' =>'0812342255677'
            ],
            'item_details' => [
                [
                    'id' => $pricing->id,
                    'price' => (int) $pricing->price,
                    'quantity' => 1,
                    'name' => $pricing->name,
                ],
                [
                    'id' => 'tax',
                    'price' => (int) $totalTax,
                    'quantity' => 1,
                    'name' => 'PPN 11%',
                ],
            ],
            'custom_fields' => [
                'custom_field1' => $user->id,
                'custom_field2' => $pricingId,
            ],
         ];


         return $this->midtransService->createSnapToken($params);
    }
}
