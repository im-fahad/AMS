<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'avatar' => 'image',
            'bio' => 'max:200',
//            'role' => 'required',
//            'company_id' => 'required',
//            'department_id' => 'required',
//            'position_id' => 'required',
//            'joined_at' => 'required',
        ];
    }
}
