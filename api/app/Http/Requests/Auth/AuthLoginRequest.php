<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return response()->json([
            'status' => 'failed',
            'message' => 'Validation Error!',
            'data' => $validator->errors(),
        ], 422);
    }
}
