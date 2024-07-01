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
            "transaction_id" => $this->transaction_id,
            "document" => [
                "document_name" => $this->document_name,
                "document_file" => $this->document_file,
                "max_input_at" => $this->max_input_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ]
        ];
    }
}
