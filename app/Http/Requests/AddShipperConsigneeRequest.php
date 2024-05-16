<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddShipperConsigneeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => ['required'],
            'shipper_name' => ['required'],
            'shipper_address' => ['required'],
            'consignee_name' => ['required'],
            'consignee_address' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_id' => 'Transaction id is required',
            'shipper_name' => 'Shipper name is required',
            'shipper_address' => 'Shipper address is required',
            'consignee_name' => 'Consignee name is required',
            'consignee_address' => 'Consignee address is required'

        ];
    }
}
