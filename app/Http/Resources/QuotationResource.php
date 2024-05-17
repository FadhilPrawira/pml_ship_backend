<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                "transaction_id" => $this->transaction_id,
                "port_of_loading_id" => $this->portOfLoading['name'],
                "port_of_discharge_id" => $this->portOfDischarge['name'],
                "date_of_loading" => $this->date_of_loading,

//                Kapal A dipilih
//
//Rute: Lokasi terakhir kapal A- Pelabuhan loading - Pelabuhan discharge
//Estimasi hari (estimasi waktu dari lokasi terakhir menuju pelabuhan loading + estimasi waktu perjalanan dengan barang[sudah termasuk lamanya bongkar muat] = 10 hari)
//Estimasi biaya (biaya perjalanan dari lokasi tearkhir + biaya perjalanan)
//

            ]
        ];
    }
}
