<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RegionRequest extends FormRequest
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
                    'name_ar' => 'required|string|min:2|unique:regions,name_ar,NULL,id,deleted_at,NULL',
                    'name_en' => 'required|string|min:2|unique:regions,name_en,NULL,id,deleted_at,NULL',
                    'state_id'=>'required|exists:states,id'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name_ar' => 'required|string|min:2',
                    'name_en' => 'required|string|min:2',
                    'state_id' => 'required|exists:states,id',
                 

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
            'name_en.unique' => 'name en is unique!',
            'name_ar.unique' => 'name ar is unique!',
            'state_id.required'=>'State Required'

        ];
    }

}


