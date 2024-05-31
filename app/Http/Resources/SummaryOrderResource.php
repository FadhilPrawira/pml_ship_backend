<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SummaryOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                "transaction_id" => $this->transaction_id,
                "vessel_name"=> $this->vesselName['vessel_name'],
                "port_of_loading_name" => $this->portOfLoading['name'],
                "port_of_discharge_name" => $this->portOfDischarge['name'],
                "date_of_loading" => $this->date_of_loading,
                "date_of_discharge" => $this->date_of_discharge,
                "cargo_description" => $this->cargo_description,
                "cargo_weight" => $this->cargo_weight,
                "shipping_cost" => (int) $this->shipping_cost,
                "handling_cost" => (int) $this->handling_cost,
                "biaya_parkir_pelabuhan" => (int) $this->biaya_parkir_pelabuhan,
                "shipper_name" => $this->shipper_name,
                "shipper_address" => $this->shipper_address,
                "consignee_name" => $this->consignee_name,
                "consignee_address" => $this->consignee_address,
                "negotiation_approved_at"=> $this->negotiation_approved_at,
                "updated_at" => $this->updated_at,
                "created_at" => $this->created_at,
            ]
        ];
    }
}
