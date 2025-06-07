<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
