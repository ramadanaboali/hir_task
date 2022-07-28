<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class NotificationRequest extends FormRequest
{

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
                    'type' => 'required|in:info,alert,reminder|min:2',
                    'message' => 'required|string|min:2',
                    'sender_id' => 'required|exists:users,id',
                    'user_id'=>'required|exists:users,id'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [];
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







