<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';
    protected $fillable = ['product_id', 'university_name'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



}
