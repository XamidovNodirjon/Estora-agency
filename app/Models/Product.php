<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'user_id',
        'region_id',
        'city_id',
        'price',
        'description',
        'images',
        'phone',
        'floor',
        'building_floor',
        'square',
        'rooms',
        'repair',
        'sotix',
    ];

    public function isPhoneVisibleTo($user)
    {
        return \App\Models\ProductView::where('manager_id', $user->id)
            ->where('product_id', $this->id)
            ->exists();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
