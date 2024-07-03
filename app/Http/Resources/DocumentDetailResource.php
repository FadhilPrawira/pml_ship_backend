<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "transaction_id" => $this->order_transaction_id,
            "document" => [
                "document_name" => $this->document_name,
                "document_type" => $this->document_type,
                "max_input_at" => $this->max_input_at,
                "uploaded_at" => $this->uploaded_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ]
        ];
    }
}
