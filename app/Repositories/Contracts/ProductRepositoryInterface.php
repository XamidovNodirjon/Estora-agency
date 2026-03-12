<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * Barcha mahsulotlarni user, category va subcategory bilan birga olish
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPublishedWithRelations();

    /**
     * ID bo'yicha mahsulotni olish
     *
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product;

    /**
     * Yangi mahsulot yaratish
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * Mahsulotni yangilash
     *
     * @param Product $product
     * @param array $data
     * @return Product
     */
    public function update(Product $product, array $data): Product;

    /**
     * Mahsulotni o'chirish
     *
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product): bool;

    /**
     * Mahsulot statusini yangilash
     *
     * @param Product $product
     * @param string $status
     * @return bool
     */
    public function updateStatus(Product $product, string $status): bool;
}