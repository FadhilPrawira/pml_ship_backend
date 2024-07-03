<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentOptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'payAllAtOnce' => [
                'firstPayment' => $this['payAllAtOnce']['total'],
            ],
            'payIn2Times' => [
                'firstPayment' => $this['payIn2Times']['firstPayment'],
                'secondPayment' => $this['payIn2Times']['secondPayment'],
            ],
            'payIn3Times' => [
                'firstPayment' => $this['payIn3Times']['firstPayment'],
                'secondPayment' => $this['payIn3Times']['secondPayment'],
                'thirdPayment' => $this['payIn3Times']['thirdPayment'],
            ],
        ];
    }
}
