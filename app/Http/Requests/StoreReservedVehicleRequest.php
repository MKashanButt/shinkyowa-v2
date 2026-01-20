<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreReservedVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && !Auth::user()
            ->hasRole('customer');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stock_id' => ['required', 'exists:stocks,sid'],
            'cnf' => ['required', 'numeric', 'min:0'],
            'customer_account_id' => ['required', 'exists:customer_accounts,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'stock_id.required' => 'The Stock ID is required.',
            'stock_id.exists' => 'The stock does not exist.',

            'cnf.required' => 'CNF amount is required.',
            'cnf.numeric' => 'CNF amount should be valid numbers.',
            'cnf.min' => 'CNF amount should be more than zero.',

            'customer_account_id.required' => 'A Customer Account is required.',
            'customer_account_id.exists' => 'The provided customer account does not exist.',
        ];
    }
}
