<?php

namespace App\Repositories;

use App\Models\Pricing;
use Illuminate\Support\Collection;
use App\Repositories\PricingRepositoryInterface;

class PricingRepository implements PricingRepositoryInterface
{
    public function findById(int $id): ?Pricing
    {
        return Pricing::find($id); // Ini seharusnya bekerja
    }

    public function getAll(): Collection
    {
        return Pricing::all();
    }
}
