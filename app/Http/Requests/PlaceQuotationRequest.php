<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PlaceQuotationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => ['required'],
            'vessel_id' => ['required'],
            'date_of_discharge' => ['required'],
            'estimated_total_cost'=> ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response(
                [
                    "errors" => $validator->errors()->messages(),
                ],
                400
            )
        );
    }

    public function messages(): array
    {
        return [
            'transaction_id.required' => 'Transaction id is required',
            'vessel_id.required' => 'Vessel id is required',
            'date_of_discharge.required' => 'Date of discharge is required',
            'estimated_total_cost.required' => 'Total cost is required',
        ];
    }
}
