<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReigterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required|max:191',
            'phone' => 'required',
            'address' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute: khong dc de trong',
            'email.email' => ':attribute: email sai dinh dang',
            'email.unique' => ':attribute: email da ton tai',
            'max' => ':attribute: khong dc qua : max ky tu'

        ];  
    }
}
