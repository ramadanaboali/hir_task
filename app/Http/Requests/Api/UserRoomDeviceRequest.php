<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UserRoomDeviceRequest extends FormRequest
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
                    'userRoom_id' => 'required|integer|exists:user_rooms,id',
                    'device_id' => 'required|integer|exists:devices,id',


                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'userRoom_id' => 'sometimes|integer|exists:user_rooms,id',
                    'device_id' => 'sometimes|integer|exists:devices,id',
                    'reading' => 'sometimes|nullable|min:0',
                    'reading_type' => 'sometimes|nullable|in:value,status',
                    'event_action' => 'sometimes|nullable|in:1,0',
                    'event_value' => 'sometimes|nullable|min:0',
                    'event_value_2' => 'sometimes|nullable|min:0',
                    'relay' => 'sometimes|integer|in:0,1',
                    'relay_2' => 'sometimes|nullable|in:0,1',
                    'relay_3' => 'sometimes|nullable|in:0,1',
                    'relay_4' => 'sometimes|nullable|in:0,1',
                    'door_type' => 'sometimes|nullable|in:0,1',
                    'switch_2' => 'sometimes|nullable',
                    'switch_3' => 'sometimes|nullable',
                    'switch_4' => 'sometimes|nullable',
                    'switch_1' => 'sometimes|nullable',
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
