<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceQuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Quotation placed',
            'transaction_id' => $this->transaction_id,
            'order' => [
                'vessel_name' => $this->vessel_name,
            ],

        ];



    }
}
