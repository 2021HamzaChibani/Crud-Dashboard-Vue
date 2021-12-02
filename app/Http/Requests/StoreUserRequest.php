<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'password'=> 'required',
            'name' => 'required',
            'email' => 'required|email',
            'street' => 'required',
            'phone' => 'required',
            'city' => 'nullable',
            'region' => 'nullable',
            'lastname' => 'nullable',
            'country' => 'nullable',
        ];
    }
}
