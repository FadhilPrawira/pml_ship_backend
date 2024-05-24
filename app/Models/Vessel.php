<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vessels';

    protected $fillable = [
        'vessel_name',
        'vessel_lat',
        'vessel_lon',
        'vessel_vts_speed_knot',
        'vessel_calc_speed_knot',
        'vessel_heading_degree',
        'vessel_tx_id',
        'pml_last_updated_at'
    ];

    // public $timestamps = false;

}
