<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:15',
                'regex:/^\+?[0-9]+$/',
                Rule::unique('users', 'phone_number')->ignore($this->customer),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->customer),
            ],
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'neighbourhood_id' => 'nullable|exists:neighbourhoods,id',
            'zip_code' => 'nullable|string|max:10',
            'customer_address_id' => 'required|exists:customer_addresses,id',

            'address' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
            'is_verified' => 'nullable|boolean',
        ];
    }
}
