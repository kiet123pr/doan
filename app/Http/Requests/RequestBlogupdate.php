<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RequestBlogupdate extends FormRequest
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
            'content' => 'required',
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute :khong dc de trong',
            'image' => ':attribute : hinh anh upload phai la hinh anh',
            'mimes' => ':attribute : hinh anh upload len phai dinh dang nhu sau : jpeg,png,jpg,gif',
            'image.max' => ':attribute : hinh anh upload len vuot qua kick thuoc cho phep :max'
        ];
    }
}
