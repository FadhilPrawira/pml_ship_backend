<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRegisterSuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "status" => "success",
            "message" => "User registered successfully",
            "data" => [
                "status" => $this->status,
                "role" => $this->role,
                "user" => [
                    "name" => $this->name,
                    "phone" => $this->phone,
                    "email" => $this->email,
                ],
                "company" => [
                    "company_name" => $this->company_name,
                    "company_address" => $this->company_address,
                    "company_phone" => $this->company_phone,
                    "company_email" => $this->company_email,
                    "company_NPWP" => $this->company_NPWP,
                    "company_akta" => $this->company_akta,
                ],
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],

        ];
    }
}
