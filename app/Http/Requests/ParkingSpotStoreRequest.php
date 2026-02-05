<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParkingSpotStoreRequest extends FormRequest
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
            'parkingspot_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:normal,electric,disabled,compact',
            'status' => 'required|string|in:available,occupied,maintenance',
            'vehicle_fuel_type' => 'required|string|in:petrol,diesel,eqlectric,hybrid',
        ];
    }
}
