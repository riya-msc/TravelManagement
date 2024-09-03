<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'package_name' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'package_duration' => 'required',
            'package_price' => 'required',
            'package_rating' => 'required|numeric',
            'package_person' => 'required|numeric',
            'validity' => 'required',
            'package_banner' => 'nullable|mimes:jpeg,jpg,png',
        ];
    }
}
