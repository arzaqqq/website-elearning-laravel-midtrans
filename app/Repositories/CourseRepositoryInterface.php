<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function searchByKeyword(string $kyword): Collection;
    public function getAllWithCategory(): Collection;
}
