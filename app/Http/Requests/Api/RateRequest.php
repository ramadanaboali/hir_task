<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RateRequest extends FormRequest
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
                    'user_id' => 'required|exists:users,id',
                    'organization_id' => 'required|exists:users,id',
                    'rate' => 'required|integer|min:1|max:5',
                    'message' => 'nullable|string|min:2',
                    ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'user_id' => 'required|exists:users,id',
                    'organization_id' => 'required|exists:users,id',
                    'rate' => 'required|integer|min:1|max:5',
                    'message' => 'nullable|string|min:2',
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
