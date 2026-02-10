<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
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
            'license_plate' => 'required|string|unique:vehicle,license_plate',
            'model' => 'required|string',
            'brand' => 'required|string',
            'year' => 'required|integer|min:1886|max:' . date('Y'),
            'fuel_type' => 'required|string',
            'vehicle_type' => 'required|string',
        ];
    }
}
