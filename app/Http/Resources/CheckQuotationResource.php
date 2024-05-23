<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckQuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vessel_id' => $this['vessel_id'],
            'vessel_name' => $this['vessel_name'],
            'port_of_loading_name' => $this['port_of_loading_name'],
            'port_of_discharge_name' => $this['port_of_discharge_name'],
            'port_of_loading_latitude' => $this['port_of_loading_latitude'],
            'port_of_loading_longitude' => $this['port_of_loading_longitude'],
            'port_of_discharge_latitude' => $this['port_of_discharge_latitude'],
            'port_of_discharge_longitude' => $this['port_of_discharge_longitude'],
            'date_of_loading' => $this['date_of_loading'],
            'estimated_day' => $this['estimated_day'],
            'estimated_date_of_discharge' => $this['estimated_date_of_discharge'],
            'estimated_cost' => $this['estimated_cost'],
        ];
    }
}
