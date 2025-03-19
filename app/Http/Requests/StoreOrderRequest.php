<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_first_name'       => 'required|string|max:255',
            'customer_last_name'        => 'required|string|max:255',
            'customer_phone_number'     => 'required|string|max:15|regex:/^\+?[0-9]+$/',

            'customer_country_id'       => 'nullable|exists:countries,id',
            'customer_city_id'          => 'nullable|exists:cities,id',
            'customer_neighbourhood_id' => 'nullable|exists:neighbourhoods,id',
            'customer_zip_code'         => 'nullable|string|max:10',
            'customer_address'          => 'nullable|string|max:500',

            'customer_id'               => 'nullable',

            'amount'                    => 'nullable|numeric|min:0',
            'delivery_charge'           => 'nullable|numeric|min:0',
            'total_amount'              => 'required|numeric|min:0',
            // 'pickup_location' => 'required|string|max:255',
            // 'delivery_location' => 'required|string|max:255',
            'pickup_time'               => 'nullable|date',
            'delivery_time'             => 'nullable|date|after_or_equal:pickup_time',
            'payment_status'            => 'required|string|in:paid,not_paid',

        ];
    }
}
