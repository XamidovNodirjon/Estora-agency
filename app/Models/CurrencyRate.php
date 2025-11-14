<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $fillable = ['base','rates','fetched_at'];

    protected $casts = [
        'rates' => 'array',      // rates ustuni avtomatik array bo‘lib chiqadi
        'fetched_at' => 'datetime',
    ];
}
