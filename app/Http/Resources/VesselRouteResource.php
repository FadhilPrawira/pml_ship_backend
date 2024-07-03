<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VesselRouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "vessel_id" => $this->id,
            "vessel_name" => $this->vessel_name,
            "day_estimation" => $this->day_estimation,
            "estimated_date_of_discharge" => $this->estimated_date_of_discharge,
            "port_of_loading" => [
                "name" => $this->port_of_loading_name,
                "latitude" => $this->port_of_loading_latitude,
                "longitude" => $this->port_of_loading_longitude,
            ],
            "port_of_discharge" => [
                "name" => $this->port_of_discharge_name,
                "latitude" => $this->port_of_discharge_latitude,
                "longitude" => $this->port_of_discharge_longitude,
            ],
            "cost" => [
                "shipping_cost" => $this->shipping_cost,
                "handling_cost" => $this->handling_cost,
                "biaya_parkir_pelabuhan" => $this->biaya_parkir_pelabuhan
            ],
        ];
    }
}
