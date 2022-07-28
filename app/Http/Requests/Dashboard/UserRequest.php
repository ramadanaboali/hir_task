<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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

                    'name' => ['required', 'string', 'max:255'],
//                    'latitude' => ['required', 'string', 'max:255'],
//                    'longitude' => ['required', 'string', 'max:255'],
//                    'address' => ['required', 'string', 'max:255'],
                    'email' => 'nullable|unique:users,email',
                    'type' => 'required|in:subAdmin,user',
//                    'charity_id' => 'required_if:type,==,volunteer|exists:users,id',
                    'phone' => 'required|unique:users,phone|regex:/^[0-9\-\(\)\/\+\s]*$/',
                    'password' => ['required', 'string', 'min:8', 'confirmed'],

                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                        'name_ar' => 'sometimes|string|min:2|unique:users,name_ar,NULL,id,deleted_at,NULL' . $this->id,
                        'name_en' => 'sometimes|string|min:2|unique:users,name_en,NULL,id,deleted_at,NULL' . $this->id,
//                        'latitude' => ['required', 'string', 'max:255'],
//                        'longitude' => ['required', 'string', 'max:255'],
//                        'address' => ['required', 'string', 'max:255'],
                        'email' => 'nullable|unique:users,email',
                        'type' => 'required|in:subAdmin,user',
//                        'charity_id' => 'required_if:type,==,volunteer,charity_id|exists:users,id',
                        'phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/|unique:users,phone',
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'logo'=>'sometimes|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'name ar is required!',
            'emai.required' => 'name en is required!',
            'latitude.required' => 'latitude ar is required!',
            'longitude.required' => 'longitude en is required!',
            'logo.image' => 'Logo is image!'
        ];
    }

}
