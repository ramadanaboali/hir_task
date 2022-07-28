<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AuthProfileRequest extends FormRequest
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
        return [
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|unique:users,phone,NULL,id,deleted_at,NULL'.request()->segment(3),
            'email' => 'nullable|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL' . request()->segment(3),
            'latitude' => ['sometimes', 'string', 'max:255'],
            'longitude' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'string', 'max:255'],
            'state_id' => 'sometimes|exists:states,id',
            'type' => 'sometimes|in:donor,volunteer,charity,branch',
            'response_name' => 'required_if:type,==,charity|string|min:2',
            'charity_id' => 'sometimes|exists:users,id',
            'region_id' => 'sometimes|exists:regions,id',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(responseFail('Validation Error', 401, $errors));
    }
}
