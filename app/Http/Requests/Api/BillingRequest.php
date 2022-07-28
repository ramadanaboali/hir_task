<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BillingRequest extends FormRequest
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
                    'lang' => 'required|string|in:ar,en',
                    'type' => 'required|string|in:card,wallet,kiosh',
                    'first_name' => 'required|string|min:2',
                    'last_name' => 'required|string|min:2',
                    'phone_number' => 'required|string|min:5',
                    'email' => 'required|email|min:5',
                    'amount' => 'required|integer|min:1',
                    'subscription_id' => 'required|exists:subscriptions,id'
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
