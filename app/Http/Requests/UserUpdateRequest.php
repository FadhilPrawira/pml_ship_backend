<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['max:100', 'string'],
            'phone' => ['max:20', 'string'],
            'email' => ['max:100', 'email'],
            'password' => [Password::min(8), 'max:255'],
            'company_name' => ['max:255', 'string'],
            'company_address' => ['max:255', 'string'],
            'company_phone' => ['max:20', 'string'],
            'company_email' => ['email', 'max:100'],
            'company_NPWP' => ['max:20', 'string'],


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

            'name.max' => 'Name must be at most 100 characters',


            'phone.max' => 'Phone must be at most 20 characters',

            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be at most 100 characters',


            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be at most 255 characters',


            'company_name.max' => 'Company name must be at most 255 characters',


            'company_address.max' => 'Company address must be at most 255 characters',


            'company_phone.max' => 'Company phone must be at most 20 characters',


            'company_email.email' => 'Company email must be a valid email address',
            'company_email.max' => 'Company email must be at most 100 characters',


            'company_NPWP.max' => 'Company NPWP must be at most 20 characters',


        ];
    }
}
