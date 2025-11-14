<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as BaseCollection;

interface ManagerRepositoryInterface
{
    /**
     * Menejer sahifasi uchun filtrlangan va tanlangan maydonlarga ega mahsulotlar ro'yxatini oladi.
     *
     * @param Request $request
     * @return BaseCollection
     */
    public function getFilteredProductsForManager(Request $request): BaseCollection;

    /**
     * Mahsulot yaratish/tahrirlash formasi uchun barcha kategoriyalar va manzillarni oladi.
     *
     * @return array
     */
    public function getCreationFormData(): array;

    /**
     * Telefon raqamini ko'rish uchun ball miqdorini tekshiradi va Ball/ProductView yozuvlarini yaratadi.
     *
     * @param int $managerId
     * @param Product $product
     * @return bool True agar raqam muvaffaqiyatli ko'rsatilsa.
     */
    public function recordPhoneView(int $managerId, Product $product): bool;

    /**
     * Menejer oldin ko'rgan mahsulotlar ro'yxatini oladi.
     *
     * @param int $managerId
     * @return Collection
     */
    public function getSeenProducts(int $managerId): Collection;

    /**
     * ID bo'yicha mahsulotni barcha kerakli aloqalar bilan oladi (show view uchun).
     *
     * @param int $id
     * @return Product|null
     */
    public function getProductByIdWithRelations(int $id): ?Product;
}