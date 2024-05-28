<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "message" => "Port, date, and cargo details created successfully",
                "transaction_id" => $this->transaction_id,
                "order" => [
                    'port_of_loading_id' => $this->port_of_loading_id,
                    'port_of_discharge_id' => $this->port_of_discharge_id,
                    'date_of_loading' => $this->date_of_loading,
                    'cargo_description' => $this->cargo_description,
                    'cargo_weight' => $this->cargo_weight
                ]
            ]
        ];
    }
}
