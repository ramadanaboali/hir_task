<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AlarmRequest extends FormRequest
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
                    'time' => 'required|string|min:2',
                    'userRoomDevice_id' => 'required|integer|min:1|exists:user_room_devices,id',
                    'notify'=>'required|integer|in:0,1',
                    'bother'=>'required|integer|in:0,1',


                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'time' => 'required|string|min:2',
                    'userRoomDevice_id' => 'required|numeric|min:1|exists:user_room_devices,id',
                    'notify'=>'required|integer|in:0,1',
                    'bother'=>'required|integer|in:0,1',
                    'active' => 'sometimes|integer|in:0,1',

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
