<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterUserRequest extends FormRequest
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
            "name" => ["required", "string", "max:254"],
            "email" => ["required", "email", "max:254"],
            "password" => ["required", "string", "max:254"],
            "company" => ["required", "string", "max:150", "unique:users,company"]
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            "name.required" => "name is required",
            "name.string" => "name should be a valid character",
            "name.max" => "name should be under 254 characters",

            "email.required" => "email is required",
            "email.email" => "email should be a valid email",
            "email.max" => "email should be under 254 characters",

            "password.required" => "password is required",
            "password.string" => "password should be a valid character",
            "password.max" => "password should be under 254 characters",

            "company.required" => "company name is required",
            "company.string" => "company name should be a valid character",
            "company.max" => "company name should be under 150 characters",
            "company.unique" => "company name already present"
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422));
    }
}
