<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchResource extends JsonResource
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
                'id' => $this->id,
                'role' => $this->role,
                'name' => $this->name,
                'email' => $this->email,
                "company_name" => $this->company_name,
                "company_address" => $this->company_address,
                "company_phone" => $this->company_phone,
                "company_email" => $this->company_email,
                "company_NPWP" => $this->company_NPWP,
                "company_akta_url" => $this->company_akta_url,
            ]
        ];
    }
}
