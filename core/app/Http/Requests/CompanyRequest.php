<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'email|max:100',
            'phone' => 'max:20',
            'address' => 'max:200',
            'logo' => 'image',
            'description' => 'max:1000',
            'weekly_working_days' => 'required|max:7',
            'week_start' => 'required|max:7',
            'week_end' => 'required|max:7',
            'daily_working_hour' => 'required',
            'hour_start' => 'required',
            'hour_end' => 'required',
            'yearly_leave' => 'required',
        ];
    }
}
