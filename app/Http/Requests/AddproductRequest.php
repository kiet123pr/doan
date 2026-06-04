<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddproductRequest extends FormRequest
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
            'name' => 'required|max:191',
            'price' => 'required|numeric|min:0',
            'company' => 'required',
            'id_category' => 'required',
            'id_brand' => 'required',
            'status' => 'required|in:0,1',
            'sale'   => 'required_if:status,1|numeric|min:0|max:100',
        ];
    }
    public function messages(){
        return [
        'required' => ':attribute: không được để trống',
        'numeric' => ':attribute: phải là số',
        'in' => ':attribute: vui lòng chọn status',
        'min' => ':attribute: vui lòng nhập số khác',
        'max' => ':attribute: vui lòng nhập số khác'
        ];
    }
}
