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
        'date_of_loading',
        'date_of_discharge',
        'status',
        'cargo_description',
        'cargo_weight',
        'total_cost',
        'shipping_instruction_document_url',
        'bill_of_lading_document_url',
        'cargo_manifest_document_url',
        'time_sheet_document_url',
        'draught_survey_document_url',
        'rating_star',
        'review',
        'negotiation_approved_at'

    ];

    // TODO: Fix Eloquent Relationship (Many to One) to Port Model
    // Eloquent Relationship (Many to One) to Port Model
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
}
