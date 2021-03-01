<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'password' => bcrypt($this->input('password'))
        ]);
    }

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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:200',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'User name is required, Please provide user name',
            'email.required' => 'A valid email is required for registration',
            'email.unique' => 'The email is already registered with us. Please log in instead. If you forgot the password, you can select the reset password option on the login page.',
            'password.required' => 'You must need a password for registration and after login',
        ];
    }


//    public $validator = null;
//    protected function failedValidation(Validator $validator)
//    {
//        return response()->json(['status' => 400, 'message' => 'ggggggggg']);
//    }
}
