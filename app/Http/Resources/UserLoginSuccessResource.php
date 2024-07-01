<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginSuccessResource extends JsonResource
{

    protected $token;

    public function __construct($resource, $token)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Login success',
            'data' => [
                'user' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $this->role,
                    'status' => $this->status,
                ],
                'token' => $this->token
            ]
        ];
    }
}
