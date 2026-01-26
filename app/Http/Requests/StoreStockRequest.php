<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasPermission('add_stock');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Images Section
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Multiple images, each 5MB max

            // Basic Info Section
            'chassis' => 'required|string|max:255|unique:stocks,chassis',
            'make_id' => 'required|exists:makes,id',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),

            // Pricing & Location Section
            'fob' => 'required|numeric|min:0',
            'currency_id' => 'required|exists:currencies,id',
            'country_id' => 'required|exists:countries,id',

            // Vehicle Specs Section
            'mileage' => 'required|string|max:255',
            'transmission' => [
                'required',
                Rule::in(['manual', 'automatic'])
            ],
            'fuel' => [
                'required',
                Rule::in(['diesel', 'petrol', 'electric', 'hybrid', 'gasoline'])
            ],
            'doors' => 'required|integer|min:1|max:10',
            'category_id' => 'required|exists:categories,id',
            'body_type_id' => 'required|exists:body_types,id',
            'features' => 'required|array',
            'features.*' => 'string|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Images
            'thumbnail.required' => 'The thumbnail image is required.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.max' => 'The thumbnail may not be greater than 5MB.',
            'images.required' => 'At least one vehicle image is required.',
            'images.*.image' => 'Each image must be a valid image file.',
            'images.*.max' => 'Each image may not be greater than 5MB.',

            // Basic Info
            'chassis.required' => 'The chassis number is required.',
            'chassis.unique' => 'This chassis number already exists in our system.',
            'make_id.required' => 'Please select a vehicle make.',
            'color.required' => 'Please add vehicle color.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year may not be greater than current year + 1.',

            // Vehicle Specs
            'transmission.in' => 'Please select a valid transmission type.',
            'fuel.in' => 'Please select a valid fuel type.',
            'doors.min' => 'The vehicle must have at least 1 door.',
            'doors.max' => 'The vehicle may not have more than 10 doors.',

            // General
            '*.required' => 'This field is required.',
            '*.exists' => 'The selected value is invalid.'
        ];
    }

    public function attributes()
    {
        return [
            'make_id' => 'make',
            'currency_id' => 'currency',
            'country_id' => 'country',
            'category_id' => 'category',
            'body_type_id' => 'body type',
            'images.*' => 'vehicle image'
        ];
    }
}
