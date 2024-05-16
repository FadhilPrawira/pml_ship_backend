<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddShipperConsigneeResource extends JsonResource
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
                "message" => 'Shipper and consignee added successfully',
                "transaction_id" => $this->transaction_id,
                "order" => [
                    'shipper_name' => $this->shipper_name,
                    'shipper_address' => $this->shipper_address,
                    'consignee_name' => $this->consignee_name,
                    'consignee_address' => $this->consignee_address,

                ]
            ]
        ];
    }
}
