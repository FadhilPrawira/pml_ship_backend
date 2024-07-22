<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'port_of_loading_id',
        'port_of_discharge_id',
        'day_estimation',
        'shipping_cost',
        'handling_cost',
        'biaya_parkir_pelabuhan',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'day_estimation' => 'int',
            'shipping_cost' => 'int',
            'handling_cost' => 'int',
            'biaya_parkir_pelabuhan' => 'int',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    // FIX
    public function portOfLoading()
    {
        // One to many relationship (inverse)
        // Many VesselRoute belongs to one port
        // This will return the port that owns many VesselRoute
        // Di Tabel port tidak ada field yang menyimpan id VesselRoute.
        // Di Tabel VesselRoute ada field port_of_loading_id yang menyimpan id port.
        return $this->belongsTo(Port::class, 'port_of_loading_id');
    }

    public function portOfDischarge()
    {
        // One to many relationship (inverse)
        // Many VesselRoute belongs to one port
        // This will return the port that owns many VesselRoute
        // Di Tabel port tidak ada field yang menyimpan id VesselRoute.
        // Di Tabel VesselRoute ada field port_of_discharge_id yang menyimpan id port.
        return $this->belongsTo(Port::class, 'port_of_discharge_id');
    }
}
