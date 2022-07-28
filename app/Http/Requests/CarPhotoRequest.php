<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CarPhotoRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'front_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'back_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'right_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'left_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'top_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'inside_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(responseFail($errors[array_keys($errors)[0]][0], 401, $errors));
    }
}
