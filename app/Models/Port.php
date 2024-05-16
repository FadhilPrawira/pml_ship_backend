<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ports';

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
}
