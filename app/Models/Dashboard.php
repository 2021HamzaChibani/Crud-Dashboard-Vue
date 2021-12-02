<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'country' ,
        'street' ,
        'city' ,
        'kvk',
        'email',
        'region',
        'phone',
        'password',
        'postal_code',
    ];

}