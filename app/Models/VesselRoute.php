<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselRoute extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vessel_routes';

    protected $fillable = [
        'port_of_loading_id',
        'port_of_discharge_id',
        'day_estimation',
        'shipping_cost',
        'handling_cost',
        'biaya_parkir_pelabuhan',
    ];

    public function portOfLoading()
    {
        return $this->belongsTo(Port::class, 'port_of_loading_id');
    }

    public function portOfDischarge()
    {
        return $this->belongsTo(Port::class, 'port_of_discharge_id');
    }
}
