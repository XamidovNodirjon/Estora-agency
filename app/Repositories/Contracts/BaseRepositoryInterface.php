<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories\Contracts
 */
interface BaseRepositoryInterface
{
    /**
     * Barcha modellarni olish
     * 
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Yangi model yaratish
     * 
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * ID bo'yicha topish
     * 
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Model;

    /**
     * Mavjud modelni yangilash
     * 
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * Modelni o'chirish
     * 
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;
}
