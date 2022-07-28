<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ServiceRequest extends FormRequest
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
                    'provider_id' => 'required|integer|exists:providers,id',
                    'name_ar' => 'required|string|min:2|unique:services,name_ar,NULL,id,deleted_at,NULL',
                    'name_en' => 'required|string|min:2|unique:services,name_en,NULL,id,deleted_at,NULL',
                    'logo'=>'required|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'provider_id' => 'required|integer|exists:providers,id',
                    'name_ar' => 'required|string|min:2|unique:services,name_ar,NULL,id,deleted_at,NULL'.$this->id,
                    'name_en' => 'required|string|min:2|unique:services,name_en,NULL,id,deleted_at,NULL'.$this->id,
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
