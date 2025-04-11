<?php

namespace App\Services;

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
}
