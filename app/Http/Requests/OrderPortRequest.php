<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class OrderPortRequest extends FormRequest
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
            'port_of_loading_id' => ['required'],
            'port_of_discharge_id' => ['required'],
            'date_of_loading' => ['required'],
//            'date_of_discharge' => ['required'],
            'cargo_description' => ['required'],
            'cargo_weight' => ['required']
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

    //    custom message
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'port_of_loading_id' => 'Port of loading is required',
            'port_of_discharge_id' => 'Port of discharge is required',
            'date_of_loading' => 'Date of loading is required',
//            'date_of_discharge' => 'Date of discharge is required',
            'cargo_description' => 'Cargo description is required',
            'cargo_weight' => 'Cargo weight is required'
        ];
    }
}
