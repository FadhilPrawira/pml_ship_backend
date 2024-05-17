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
                "port_of_loading_id" => $this->portOfLoading['name'],
                "port_of_discharge_id" => $this->portOfDischarge['name'],
                "date_of_loading" => $this->date_of_loading,

                "cargo_description" => $this->cargo_description,
                "cargo_weight" => $this->cargo_weight,
                "shipper_name" => $this->shipper_name,
                "shipper_address" => $this->shipper_address,
                "consignee_name" => $this->consignee_name,
                "consignee_address" => $this->consignee_address,
            ]
        ];
    }
}
