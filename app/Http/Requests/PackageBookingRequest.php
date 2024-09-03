<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageBookingRequest extends FormRequest
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
            'traveller_email' => 'required|email',
            'traveller_phone' => 'required',
            'number_of_adult' => 'required',
            'number_of_child' => 'required',
            'adult_infos.*' => 'required',
            'child_infos.*' => 'required',
            'child_infos.*.passportCopy' => 'required|image|mimes:jpeg,png,jpg',
            'journey_date' => 'required',
            'other_requirements' => 'sometimes|string',
        ];
    }
}
