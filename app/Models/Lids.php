<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lids extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'price',
        'user_id',
    ];
}
