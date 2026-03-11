<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'user_id',
        'manager_id',
        'region_id',
        'city_id',
        'price',
        'description',
        'phone',
        'floor',
        'building_floor',
        'square',
        'rooms',
        'repair',
        'sotix',
        'status',
        'landmark',
        'exchange',
        'pay_in_installments',
        'credit',
    ];


    protected $casts = [
        'status' => 'string',
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

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
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

    public function reservations()
    {
        return $this->hasMany(ReservationProduct::class);
    }


    public function getImageArrayAttribute()
    {
        // 1. Yangi relationship orqali tekshirish
        // Agar eager load qilingan bo'lsa yoki lazy load ishlatsak:
        $newImages = $this->productImages->pluck('path')->toArray();
        if (!empty($newImages)) {
            return $newImages;
        }

        // 2. Eski usul (json column) orqali tekshirish
        if (isset($this->attributes['images'])) {
            $decoded = json_decode($this->attributes['images'], true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function features()
    {
        return $this->belongsToMany(
            ProductFeatures::class,           // bog‘lanadigan model
            'product_feature_product',       // pivot table nomi
            'product_id',                    // product_id ustuni
            'product_feature_id'             // feature_id ustuni
        );
    }

    public function metros()
    {
        return $this->hasMany(Metro::class);
    }

    public function universities()
    {
        return $this->hasMany(University::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }



}
