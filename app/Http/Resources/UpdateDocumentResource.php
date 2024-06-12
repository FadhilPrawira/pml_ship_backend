<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "status" => 'success',
            "shipping_instruction_document_url" => $this->shipping_instruction_document_url,
            "bill_of_lading_document_url" => $this->bill_of_lading_document_url,
            "cargo_manifest_document_url" => $this->cargo_manifest_document_url,
            "time_sheet_document_url" => $this->time_sheet_document_url,
            "draught_survey_document_url" => $this->draught_survey_document_url,
        ];
    }
}
