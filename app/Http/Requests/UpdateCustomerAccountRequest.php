<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCustomerAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermission('can_edit_customer');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customerAccount   = $this->customer_account;
        $customerUserId    = $customerAccount->user_id;
        $customerRoleId   = Role::where('name', 'customer')->value('id');

        return [
            'name'        => ['required', 'string', 'max:100'],
            'company'     => ['required', 'string', 'max:200'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('customer_accounts', 'email')
                    ->ignore($customerAccount->id),
                Rule::unique('users', 'email')
                    ->where(fn($q) => $q->where('role_id', $customerRoleId))
                    ->ignore($customerUserId),
            ],
            'phone'       => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
            'whatsapp'    => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s()]+$/'],
            'password'    => ['nullable', 'string', 'min:6'],
            'description' => ['nullable', 'string', 'max:244'],
            'address'     => ['required', 'string', 'max:244'],
            'city'        => ['required', 'string', 'max:244'],
            'country_id' => ['required', 'string'],
            'currency_id' => ['required', 'string'],
            'agent_id'   => ['nullable', 'string'],
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
            'name.required'        => 'Name is required.',
            'name.max'             => 'Name must not exceed 100 characters.',

            'company.required'     => 'Company name is required.',
            'company.max'          => 'Company name must not exceed 200 characters.',

            'email.required'       => 'Email is required.',
            'email.email'          => 'Please enter a valid email address.',
            'email.max'            => 'Email must not exceed 150 characters.',
            'email.unique'         => 'This email is already in use by another customer.',

            'phone.required'       => 'Phone number is required.',
            'phone.regex'          => 'Phone number format is invalid.',
            'phone.max'            => 'Phone number must not exceed 15 characters.',

            'whatsapp.required'    => 'WhatsApp number is required.',
            'whatsapp.regex'       => 'WhatsApp number format is invalid.',
            'whatsapp.max'         => 'WhatsApp number must not exceed 15 characters.',

            'password.min'         => 'Password must be at least 6 characters.',

            'description.max'      => 'Description must not exceed 244 characters.',
            'address.required'     => 'Address is required.',
            'address.max'          => 'Address must not exceed 244 characters.',

            'city.required'        => 'City is required.',
            'city.max'             => 'City must not exceed 244 characters.',

            'country_id.required'  => 'Country is required.',
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
            'name'        => 'Name',
            'company'     => 'Company',
            'email'       => 'Email',
            'phone'       => 'Phone number',
            'whatsapp'    => 'WhatsApp number',
            'password'    => 'Password',
            'description' => 'Description',
            'address'     => 'Address',
            'city'        => 'City',
            'country_id'  => 'Country',
            'currency_id' => 'Currency',
            'agent_id'    => 'Agent',
        ];
    }
}
