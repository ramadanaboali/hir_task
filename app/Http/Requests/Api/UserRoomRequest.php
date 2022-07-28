<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserRoomRequest extends FormRequest
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
                    'room_id' => 'required|integer|exists:rooms,id',
                    'user_id' => 'required|integer|exists:users,id',


                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'room_id' => 'required|integer|exists:rooms,id',
                    'user_id' => 'required|integer|exists:users,id',
                    'active' => 'required|integer|in:0,1',

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
