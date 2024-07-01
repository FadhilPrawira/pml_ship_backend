<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            "vessel_name" => $this->vesselName['vessel_name'],
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
            'documents' => collect($this->documents)->map(function ($document) {
                return [
                    'document_name' => $document->document_name,
                    'document_type' => $document->document_type,
                    'max_input_document_at' => $document->max_input_document_at,
                    'created_at' => $document->created_at,
                    'updated_at' => $document->updated_at,
                ];
            }),
            'payment' => [
                'shipping_cost' => $this->shipping_cost,
                'handling_cost' => $this->handling_cost,
                'biaya_parkir_pelabuhan' => $this->biaya_parkir_pelabuhan,
                'tax' => $this->tax,
                'total_bill' => $this->total_bill,
                'cumulative_paid' => $this->cumulative_paid,
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
