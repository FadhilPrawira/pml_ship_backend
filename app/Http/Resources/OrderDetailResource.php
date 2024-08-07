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
                'payments' => collect($this->payments)->map(function ($payment) {
                    return [
                        'payment_date' => $payment->payment_date,
                        'payment_due_date' => $payment->payment_due_date,
                        'payment_amount' => $payment->payment_amount,
                        'payment_proof_document' => $payment->payment_proof_document,
                        'installment_number' => $payment->installment_number,
                        'total_installments' => $payment->total_installments,
                        'payment_status' => $payment->payment_status,
                        'approved_at' => $payment->approved_at,
                        'rejected_at' => $payment->rejected_at,
                        'created_at' => $payment->created_at,
                        'updated_at' => $payment->updated_at,
                    ];
                }),
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
