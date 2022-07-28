<?php

namespace App\Http\Requests\Api;

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
                    'bio' => 'string|min:5|nullable',
                    'icon' => 'string|min:5|nullable',
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
                    'name_ar' => 'required|string|min:2|unique:infos,name_ar,NULL,id,deleted_at,NULL' . request()->segment(3),
                    'name_en' => 'required|string|min:2|unique:infos,name_en,NULL,id,deleted_at,NULL' . request()->segment(3),
                    'logo_en'=>'image|mimes:jpeg,bmp,png|max:4096',
                    'logo_ar'=>'image|mimes:jpeg,bmp,png|max:4096',
                    'main_color' => 'string|min:2',
                    'secondary_color' => 'string|min:2',
                    'email_message' => 'string|min:2',
                    'phone' => 'string|min:2',
                    'phone_message' => 'string|min:2',
                    'fb_link' => 'string|min:2',
                    'tw_link' => 'string|min:2',
                    'in_link' => 'string|min:2',
                    'insta_link' => 'string|min:2',
                    'website_link' => 'string|min:2',
                    'address' => 'string|min:2',
                    'bio' => 'string|min:5',
                    'icon' => 'string|min:5',
                    'appStore_link' => 'string|min:5',
                    'googlePlay_link' => 'string|min:5',
                    'main_font_color' => 'string|min:5|nullable',
                    'secondary_font_color' => 'string|min:5|nullable',
                    'app_version' => 'string|min:5|nullable',
                ];
            }
            default:break;
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(responseFail('Validation Error',401,$errors));
    }

}
