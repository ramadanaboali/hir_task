<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
                    'name_ar' => 'required|string',
                    'name_en' => 'required|string',
                    'description_ar' => 'required|string',
                    'description_en' => 'required|string',
                    'provider_id ' =>'sometimes|nullable|exists:users,id',
                    'price' => 'required!numeric',
                    'offer_price'=>'sometimes|nullable!numeric',
                    'discount'=>'sometimes|nullable!numeric',
                    'rate' => 'sometimes|nullable|numeric',
                    'featured' => 'sometimes|nullable|numeric|in:0,1',
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'title' => 'sometimes|string|min:2|unique:cycles,title,NULL,id,deleted_at,NULL' . request()->segment(3),
                    'name_ar' => 'required|string',
                    'name_en' => 'required|string',
                    'description_ar' => 'required|string',
                    'description_en' => 'required|string',
                    'provider_id ' =>'sometimes|nullable|exists:users,id',
                    'price' => 'required!numeric',
                    'offer_price'=>'sometimes|nullable!numeric',
                    'discount'=>'sometimes|nullable!numeric',
                    'rate' => 'sometimes|nullable|numeric',
                    'featured' => 'sometimes|nullable|numeric|in:0,1',
                ];
            }
            default:break;
        }
    }



    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(responseFail('Validation Error', 401, $errors));
    }


}
