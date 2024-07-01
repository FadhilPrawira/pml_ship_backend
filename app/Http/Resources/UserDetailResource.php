<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            "role" => $this->role,
            "user" => [
                'id' => $this->id,
                "name" => $this->name,
                "phone" => $this->phone,
                "email" => $this->email,
            ],
            "company" => [
                'company_name' => $this->company_name,
                'company_address' => $this->company_address,
                'company_phone' => $this->company_phone,
                'company_email' => $this->company_email,
                'company_NPWP' => $this->company_NPWP,
                'company_akta' => $this->company_akta,
            ],
            'reason_rejected' => $this->reason_rejected,
            'rejected_at' => $this->rejected_at,
            'approved_at' => $this->approved_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
