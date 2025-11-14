<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface HomeRepositoryInterface
{
    /**
     * Dashboard uchun barcha asosiy ma'lumotlarni (Categories, Regions, Cities) oladi.
     *
     * @return array
     */
    public function getBaseData(): array;

    /**
     * Barcha Product Statistics ma'lumotlarini oladi.
     *
     * @param array $constants Constants sinfidagi doimiy qiymatlar massivi
     * @return array
     */
    public function getStatistics(array $constants): array;

    /**
     * Asosiy sahifada ko'rsatish uchun tasodifiy 10 ta eng yaxshi taklifni (Product) oladi.
     *
     * @return Collection
     */
    public function getBestOffers(): Collection;
}