<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermission('add_payment');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stock_id' => 'nullable|exists:stocks,sid',
            'description' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'in_yen' => 'numeric|min:0',
            'payment_recieved_date' => 'date',
            'customer_account_id' => 'required|exists:customer_accounts,id',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'stock_id.exists' => 'The stock ID is invalid.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description should be a valid string.',
            'description.max' => 'The description should be under 255 characters.',

            'payment_date.required' => 'The payment date is required.',
            'payment_date.date' => 'The payment date must be a valid date.',

            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.',

            'in_yen.numeric' => 'The YEN amount must be a number.',
            'in_yen.min' => 'The YEN amount must be at least 0.',

            'payment_recieved_date.date' => 'The payment received date must be a valid date.',

            'customer_account_id.required' => 'The customer account field is required.',
            'customer_account_id.exists' => 'The selected customer account is invalid.',

            'file.required' => 'A file is required.',
            'file.file' => 'The uploaded file is invalid.',
            'file.mimes' => 'The file must be a PDF, JPG, JPEG, or PNG.',
            'file.max' => 'The file may not be greater than 5MB.',
        ];
    }

    public function attributes()
    {
        return [
            'stock_id' => 'Stock ID',
            'description' => 'Description',
            'payment_date' => 'Payment Date',
            'amount' => 'Amount',
            'in_yen' => 'YEN Amount',
            'payment_recieved_date' => 'Payment Received Date',
            'customer_account_id' => 'Customer Account',
            'file' => 'File',
        ];
    }
}
