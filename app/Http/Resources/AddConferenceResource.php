<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddConferenceResource extends JsonResource
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
                "message" => 'Conference added successfully',
                "transaction_id" => $this->transaction_id,
                "conference_detail" => [
                    'conference_type' => $this->conference_type,
                    'location' => $this->location,
                    'conference_date' => $this->conference_date,
                    'conference_time' => $this->conference_time,

                ]
            ]
        ];
    }
}
