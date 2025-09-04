<?php

namespace App\Models;

// Bu qatorni import qilishingiz kerak
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'sure_name',
        'phone',
        'email',
        'password',
        'images'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
