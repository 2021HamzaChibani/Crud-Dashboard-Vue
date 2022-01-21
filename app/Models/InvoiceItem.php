<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'price' ,
        'quantity' ,
    ];

    protected $casts = [
        'price' => 'float',
        'quantity' => 'float',
    ];


    public function invoices()
    {
        return $this->belongsTo(Invoice::class);
    }
}
