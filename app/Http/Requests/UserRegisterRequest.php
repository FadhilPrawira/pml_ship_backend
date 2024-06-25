<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class UserRegisterRequest extends FormRequest
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
            'name' => ['required', 'max:100'],
            'phone' => ['required', 'max:20'],
            'email' => ['required', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8), 'max:255'],
            'company_name' => ['required', 'max:255'],
            'company_address' => ['required', 'max:255'],
            'company_phone' => ['required', 'max:20'],
            'company_email' => ['required', 'email', 'max:100'],
            'company_NPWP' => ['required', 'max:20'],

            'company_akta_url' => ['required', File::types(['pdf'])],
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
            'name.required' => 'Name is required',
            'name.max' => 'Name must be at most 100 characters',

            'phone.required' => 'Phone is required',
            'phone.max' => 'Phone must be at most 20 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be at most 100 characters',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be at most 255 characters',

            'company_name.required' => 'Company name is required',
            'company_name.max' => 'Company name must be at most 255 characters',

            'company_address.required' => 'Company address is required',
            'company_address.max' => 'Company address must be at most 255 characters',

            'company_phone.required' => 'Company phone is required',
            'company_phone.max' => 'Company phone must be at most 20 characters',

            'company_email.required' => 'Company email is required',
            'company_email.email' => 'Company email must be a valid email address',
            'company_email.max' => 'Company email must be at most 100 characters',

            'company_NPWP.required' => 'Company NPWP is required',
            'company_NPWP.max' => 'Company NPWP must be at most 20 characters',

            'company_akta_url.required' => 'Company akta url is required',
            // 'company_akta_url.max' => 'Company akta url must be at most 255 characters',
            'company_akta_url.file' => 'Company akta url must be a pdf file',
        ];
    }
}
