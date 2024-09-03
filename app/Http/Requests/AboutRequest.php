<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required',
            'main_image' => 'nullable|mimes:jpeg,jpg,png',
            'image1' => 'nullable|mimes:jpeg,jpg,png',
            'image2' => 'nullable|mimes:jpeg,jpg,png'
        ];
    }
}
