<?php

namespace App\Http\Requests\Dashboard;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class SliderRequest extends FormRequest
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
      //  dd($_REQUEST);
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name_ar' => 'required|string|min:2|unique:sliders,name_ar,NULL,id,deleted_at,NULL',
                    'name_en' => 'required|string|min:2|unique:sliders,name_en,NULL,id,deleted_at,NULL',
                    'photo'=>'required',
                    'text_en'=>'string|min:5|nullable',
                    'text_ar'=>'string|min:5|nullable'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name_ar' => 'required|string|min:2|unique:sliders,name_ar,NULL,id,deleted_at,NULL'.$this->id,
                    'name_en' => 'required|string|min:2|unique:sliders,name_en,NULL,id,deleted_at,NULL'.$this->id,
                    'photo'=>'sometimes',
                    'text_en'=>'string|min:5|nullable',
                    'text_ar'=>'string|min:5|nullable'
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
            'photo.required' => 'photo is required!',
            'photo.image' => 'photo is image!'
        ];
    }

}
