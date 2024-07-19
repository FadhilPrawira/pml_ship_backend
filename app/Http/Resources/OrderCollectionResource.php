<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'transaction_id' => $this->transaction_id,
            'customer_company_name' => $this->user->company_name,
            'vessel' => [
                "vessel_name" => $this->vesselName['vessel_name'],
                "vessel_lat" => $this->vesselName['vessel_lat'],
                "vessel_lon" => $this->vesselName['vessel_lon'],
                "vessel_vts_speed_knot" => $this->vesselName['vessel_vts_speed_knot'],
                "vessel_calc_speed_knot" => $this->vesselName['vessel_calc_speed_knot'],
                "vessel_heading_degree" => $this->vesselName['vessel_heading_degree'],
                "pml_last_updated_at" => $this->vesselName['pml_last_updated_at'],
            ],
            'loading' => [
                'port' => $this->portOfLoading['name'],
                'date' => $this->date_of_loading,
            ],
            'discharge' => [
                'port' => $this->portOfDischarge['name'],
                'date' => $this->date_of_discharge,
            ],
            'cargo' => [
                'description' => $this->cargo_description,
                'weight' => $this->cargo_weight,
            ],
            'shipper' => [
                'name' => $this->shipper_name,
                'address' => $this->shipper_address,
            ],
            'consignee' => [
                'name' => $this->consignee_name,
                'address' => $this->consignee_address,
            ],
            'rating' => [
                'star' => $this->rating_star,
                'review' => $this->review,
            ],
            'negotiation_or_order_approved_at' => $this->negotiation_or_order_approved_at,
            'order_rejected_at' => $this->order_rejected_at,
            'order_canceled_at' => $this->order_canceled_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
