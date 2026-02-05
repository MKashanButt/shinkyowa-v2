<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check()
            && Auth::user()->hasPermission('can_edit_document');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'stock_id' => [
                'required',
                'integer',
                Rule::exists('stocks', 'sid')
            ],
            'japanese_export' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
            'english_export' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
            'final_invoice' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
            'inspection_certificate' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
            'bl_copy' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'stock_id.required' => 'The stock ID field is required.',
            'stock_id.exists' => 'The selected stock ID is invalid.',
            'japanese_export.mimes' => 'Japanese export must be a PDF, JPG, JPEG, or PNG file.',
            'japanese_export.max' => 'Japanese export file must not exceed 2MB.',
            'english_export.mimes' => 'English export must be a PDF, JPG, JPEG, or PNG file.',
            'english_export.max' => 'English export file must not exceed 2MB.',
            'final_invoice.mimes' => 'Final invoice must be a PDF, JPG, JPEG, or PNG file.',
            'final_invoice.max' => 'Final invoice file must not exceed 2MB.',
            'inspection_certificate.mimes' => 'Inspection certificate must be a PDF, JPG, JPEG, or PNG file.',
            'inspection_certificate.max' => 'Inspection certificate file must not exceed 2MB.',
            'bl_copy.mimes' => 'BL copy must be a PDF, JPG, JPEG, or PNG file.',
            'bl_copy.max' => 'BL copy file must not exceed 2MB.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        if ($this->stock_id === '') {
            $this->merge([
                'stock_id' => null,
            ]);
        }
    }
}
