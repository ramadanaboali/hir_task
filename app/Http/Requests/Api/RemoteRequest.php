<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RemoteRequest extends FormRequest
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
                    'name' => 'required|string|min:2',
                    'plusbtn' => 'required|string|min:2',
                    'minusbtn' => 'required|string|min:2',
                    'upbtn' => 'required|string|min:2',
                    'downbtn' => 'required|string|min:2',
                    'okbtn' => 'required|string|min:2',
                    'powerbtn' => 'required|string|min:2',
                    'user_id' => 'required|integer|min:1|exists:users,id',


                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name' => 'required|string|min:2',
                    'plusbtn' => 'required|string|min:2',
                    'minusbtn' => 'required|string|min:2',
                    'upbtn' => 'required|string|min:2',
                    'downbtn' => 'required|string|min:2',
                    'okbtn' => 'required|string|min:2',
                    'powerbtn' => 'required|string|min:2',
                    'user_id' => 'required|integer|min:1|exists:users,id',
                    'active' => 'sometimes|integer|in:0,1',
                    'segmant' => 'sometimes|string|min:2',
                    'flag' => 'sometimes|integer|in:0,1',

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
