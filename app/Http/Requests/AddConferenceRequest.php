<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddConferenceRequest extends FormRequest
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
            'conference_type' => ['required'],
            'location' => ['required'],
            'conference_date' => ['required'],
            'conference_time' => ['required'],
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
        'transaction_id.required' => 'Transaction ID is required',
        'conference_type.required' => 'Type is required',
        'location.required' => 'Location is required',
        'conference_date.required' => 'Conference date is required',
        'conference_time.required' => 'Conference time is required',
        ];
    }
}
