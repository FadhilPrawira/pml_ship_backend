<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "status" => $this->status,
            "transaction_id" => $this->order_transaction_id,
            "conference" => [
                "company_name" => $this->customerCompany['company_name'],
                "type" => $this->conference_type,
                'location' => $this->location,
                'date' => $this->conference_date,
                'time' => $this->conference_time,
            ],
            "order" => [
                "loading" => [
                    "port" => $this->order['port_of_loading_id'],
                    "date" => $this->order['date_of_loading'],
                ],
                "discharge" => [
                    "port" => $this->order['port_of_discharge_id'],
                    "date" => $this->order['date_of_discharge'],
                ],
                "shipper" => [
                    'name' => $this->order['shipper_name'],
                    'address' => $this->order['shipper_address'],
                ],
                'consignee' => [
                    'name' => $this->order['consignee_name'],
                    'address' => $this->order['consignee_address'],
                ],

            ],
            "conference_approved_at" => $this->conference_approved_at,
            "conference_rejected_at" => $this->conference_rejected_at,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
