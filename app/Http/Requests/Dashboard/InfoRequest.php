<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class InfoRequest extends FormRequest
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
                    'name_ar' => 'required|string|min:2|unique:infos,name_ar,NULL,id,deleted_at,NULL',
                    'name_en' => 'required|string|min:2|unique:infos,name_en,NULL,id,deleted_at,NULL',
                    'logo_en'=>'required|image|mimes:jpeg,bmp,png|max:4096',
                    'logo_ar'=>'required|image|mimes:jpeg,bmp,png|max:4096',
                    'main_color' => 'string|min:2|nullable',
                    'secondary_color' => 'string|min:2|nullable',
                    'email_message' => 'string|min:2|nullable',
                    'phone' => 'string|min:2|nullable',
                    'phone_message' => 'string|min:2|nullable',
                    'fb_link' => 'string|min:2|nullable',
                    'tw_link' => 'string|min:2|nullable',
                    'in_link' => 'string|min:2|nullable',
                    'insta_link' => 'string|min:2|nullable',
                    'website_link' => 'string|min:2|nullable',
                    'address' => 'string|min:2|nullable',
                    'bio_ar' => 'string|min:5|nullable',
                    'bio_en' => 'string|min:5|nullable',
                    'privacy_en' => 'string|min:5|nullable',
                    'privacy_ar' => 'string|min:5|nullable',
                    'agreement_en' => 'string|min:5|nullable',
                    'agreement_ar' => 'string|min:5|nullable',
                    'icon' => 'image|mimes:jpeg,bmp,png|max:4096|nullable',
                    'appStore_link' => 'string|min:5|nullable',
                    'googlePlay_link' => 'string|min:5|nullable',
                    'main_font_color' => 'string|min:5|nullable',
                    'secondary_font_color' => 'string|min:5|nullable',
                    'app_version' => 'string|min:5|nullable',

                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name_ar' => 'required|string|min:2',
                    'name_en' => 'required|string|min:2',
                    'logo_en'=>'image|mimes:jpeg,bmp,png|max:4096|nullable',
                    'logo_ar'=>'image|mimes:jpeg,bmp,png|max:4096|nullable',
                    'main_color' => 'string|min:2|nullable',
                    'secondary_color' => 'string|min:2|nullable',
                    'email_message' => 'string|min:2|nullable',
                    'phone' => 'string|min:2|nullable',
                    'phone_message' => 'string|min:2|nullable',
                    'fb_link' => 'string|min:2|nullable',
                    'tw_link' => 'string|min:2|nullable',
                    'in_link' => 'string|min:2|nullable',
                    'insta_link' => 'string|min:2|nullable',
                    'website_link' => 'string|min:2|nullable',
                    'address' => 'string|min:2|nullable',
                    'bio' => 'string|min:5|nullable',
                    'icon' => 'image|mimes:jpeg,bmp,png|max:4096|nullable',
                    'appStore_link' => 'string|min:5|nullable',
                    'googlePlay_link' => 'string|min:5|nullable',
                    'main_font_color' => 'string|min:5|nullable',
                    'secondary_font_color' => 'string|min:5|nullable',
                    'app_version' => 'string|min:5|nullable',
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


