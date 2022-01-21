<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'country',
        'street',
        'city',
        'region',
        'phone',
        'logo',
        'signature',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'logo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'logo_url',
        'signature_url'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }

        return Storage::url($this->logo);
    }

    public function getSignatureUrlAttribute()
    {
        if (!$this->signature) {
            return null;
        }

        return Storage::url($this->signature);
    }

    public function getSignatureImageAttribute(): string
    {
        if (empty($this->signature)) {
            return '';
        }
        $signature = Storage::path($this->signature);
        $type = pathinfo($signature, PATHINFO_EXTENSION);
        $data = file_get_contents($signature);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
