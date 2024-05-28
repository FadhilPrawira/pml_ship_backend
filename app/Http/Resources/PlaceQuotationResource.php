<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceQuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Quotation placed',
            'transaction_id' => $this->transaction_id,
            'order' => [
                'vessel_id' => $this->vessel_id,
                'port_of_loading_id' => $this->port_of_loading_id,
                'port_of_discharge_id' => $this->port_of_discharge_id,
                'date_of_loading' => $this->date_of_loading,
                'date_of_discharge' => $this->date_of_discharge,
                'cargo_description' => $this->cargo_description,
                'cargo_weight' => $this->cargo_weight,
                'estimation_total_cost'=> $this->total_cost
            ],

        ];



    }
}
