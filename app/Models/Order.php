<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    //    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'shipper_name',
        'shipper_address',
        'consignee_name',
        'consignee_address',
        'port_of_loading_id',
        'port_of_discharge_id',
        'vessel_id',
        'date_of_loading',
        'date_of_discharge',
        'status',
        'cargo_description',
        'cargo_weight',
        'shipping_cost',
        'handling_cost',
        'biaya_parkir_pelabuhan',
        'tax',
        'total_bill',
        'shipping_instruction_document',
        'bill_of_lading_document',
        'cargo_manifest_document',
        'time_sheet_document',
        'draught_survey_document',
        'rating_star',
        'review',
        'negotiation_approved_at'
    ];


    public function portOfLoading()
    {
        return $this->belongsTo(Port::class, 'port_of_loading_id');
    }

    public function portOfDischarge()
    {
        return $this->belongsTo(Port::class, 'port_of_discharge_id');
    }

    public function vesselName()
    {
        return $this->belongsTo(Vessel::class, 'vessel_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'transaction_id');
    }

    // conference
    public function conferences()
    {
        return $this->hasOne(Conference::class, 'transaction_id');
    }
}
