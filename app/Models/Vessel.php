<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vessel_name',
        'vessel_lat',
        'vessel_lon',
        'vessel_vts_speed_knot',
        'vessel_calc_speed_knot',
        'vessel_heading_degree',
        'vessel_tx_id',
        'pml_internal_vessel_id',
        'pml_last_updated_at'
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'vessel_lat' => 'double',
            'vessel_lon' => 'double',
            'pml_last_updated_at' => 'datetime',

        ];
    }
}
