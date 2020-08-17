<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'A email is required',
            'email.email' => 'Email must be with @',
            'password.required' => 'A password is required',
        ];
    }

    public function failedValidation(Validator $validator) 
    {
        $response = [
            'message' => $validator->errors()->first(),
        ];
    
        throw new HttpResponseException(response()->json($response, 400));
    }
}
