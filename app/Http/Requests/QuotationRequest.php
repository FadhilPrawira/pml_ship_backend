<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuotationRequest extends FormRequest
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
            'port_of_loading_id' => ['required'],
            'port_of_discharge_id' => ['required'],
            'date_of_loading' => ['required'],

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
            'port_of_loading_id.required' => 'Port of loading id is required',
            'port_of_discharge_id.required' => 'Port of discharge id is required',
            'date_of_loading.required' => 'Date of loading is required',
        ];
    }
}
