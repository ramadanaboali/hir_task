<?php

namespace App\Http\Requests\Dashboard;
use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'service_id' => 'required|integer|exists:services,id',
                    'name_ar' => 'required|string|min:2',
                    'name_en' => 'required|string|min:2',
                    'first_headline_ar' => 'required|string|min:2',
                    'first_headline_en' => 'required|string|min:2',
                    'second_headline_ar' => 'required|string|min:2',
                    'second_headline_en' => 'required|string|min:2',
                    'description_ar' => 'required|string|min:2',
                    'description_en' => 'required|string|min:2',
                    'priceBeforeDiscount' => 'required|integer|min:1',
                    'priceAfterDiscount' => 'required|integer|min:1|lt:priceBeforeDiscount',
                    'couponValue' => 'required|integer|min:1|lt:priceAfterDiscount',
                    'points' => 'required|integer|min:1',
                    'permitDays' => 'required|integer|min:1|max:30',
                    'type' => 'required|in:monthly,quarter,annual',
                    'logo'=>'required|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'service_id' => 'required|integer|exists:services,id',
                    'name_ar' => 'required|string|min:2',
                    'name_en' => 'required|string|min:2',
                    'first_headline_ar' => 'required|string|min:2',
                    'first_headline_en' => 'required|string|min:2',
                    'second_headline_ar' => 'required|string|min:2',
                    'second_headline_en' => 'required|string|min:2',
                    'description_ar' => 'required|string|min:2',
                    'description_en' => 'required|string|min:2',
                    'priceBeforeDiscount' => 'required|integer|min:1',
                    'priceAfterDiscount' => 'required|integer|min:1|lt:priceBeforeDiscount',
                    'couponValue' => 'required|integer|min:1|lt:priceAfterDiscount',
                    'points' => 'required|integer|min:1',
                    'permitDays' => 'required|integer|min:1|max:30',
                    'type' => 'required|in:monthly,quarter,annual',
                    'logo'=>'sometimes|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'name ar is required!',
            'name_en.required' => 'name en is required!',
            'name_ar.unique' => 'name ar is unique!',
            'name_en.unique' => 'name en is unique!',
            'logo.required' => 'Logo is required!',
            'logo.image' => 'Logo is image!'
        ];
    }

}
