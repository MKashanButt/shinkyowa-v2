<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomerAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermission('add_customer');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100'],
            'company'     => ['required', 'string', 'max:200'],
            'email'       => ['required', 'email', 'max:150'],
            'phone'       => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
            'whatsapp'    => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
            'password'    => ['required', 'string', 'min:6'],
            'description' => ['nullable', 'string', 'max:244'],
            'address'     => ['required', 'string', 'max:244'],
            'city'        => ['required', 'string', 'max:244'],
            'country_id'  => ['required', 'string'],
            'currency_id' => ['required', 'string'],
            'agent_id'    => ['nullable', 'string'],
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cid.required'         => 'Customer ID is required.',

            'name.required'        => 'Name is required.',
            'name.max'             => 'Name must not exceed 100 characters.',

            'company.required'     => 'Company name is required.',
            'company.max'          => 'Company name must not exceed 200 characters.',

            'email.required'       => 'Email is required.',
            'email.email'          => 'Please enter a valid email address.',
            'email.max'            => 'Email must not exceed 150 characters.',

            'phone.required'       => 'Phone number is required.',
            'phone.regex'          => 'Phone number format is invalid.',
            'phone.max'            => 'Phone number must not exceed 15 characters.',

            'whatsapp.required'    => 'WhatsApp number is required.',
            'whatsapp.regex'       => 'WhatsApp number format is invalid.',
            'whatsapp.max'         => 'WhatsApp number must not exceed 15 characters.',

            'password.required'    => 'Password is required.',
            'password.min'         => 'Password must be at least 6 characters.',

            'description.max'      => 'Description must not exceed 244 characters.',
            'address.required'     => 'Address is required.',
            'address.max'          => 'Address must not exceed 244 characters.',

            'city.required'        => 'City is required.',
            'city.max'             => 'City must not exceed 244 characters.',

            'country.required'     => 'Country is required.',
            'currency_id.required' => 'Currency selection is required.',
        ];
    }

    /**
     * Custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'        => 'name',
            'company'     => 'company',
            'email'       => 'email',
            'phone'       => 'phone number',
            'whatsapp'    => 'WhatsApp number',
            'password'    => 'password',
            'description' => 'description',
            'address'     => 'address',
            'city'        => 'city',
            'country'     => 'country',
            'currency_id' => 'currency',
        ];
    }
}
