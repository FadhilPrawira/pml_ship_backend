<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Port extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'address',
        'country_code',
        'unlocode',
        'latitude',
        'longitude',
        'open_time',
        'close_time',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'address' => 'string',
            'country_code' => 'string',
            'unlocode' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
            'image_url' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // FIX
    public function ordersPortOfLoading(): HasMany
    {
        // One to many relationship
        // This Port has many Order
        // This will return all Order that belong to this user
        // Di Tabel Ports tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field port_of_loading_id yang menyimpan id Ports.
        return $this->hasMany(Order::class, 'port_of_loading_id');
    }

    // FIX
    public function ordersPortOfDischarge(): HasMany
    {
        // One to many relationship
        // This Port has many Order
        // This will return all Order that belong to this user
        // Di Tabel Ports tidak ada field yang menyimpan id Order.
        // Di Tabel Order ada field port_of_discharge_id yang menyimpan id Ports.
        return $this->hasMany(Order::class, 'port_of_discharge_id');
    }
}
