<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'major'=>'required',
            'phone'=>'required',
            'employee_desc'=>'required',
            'doctor_desc'=>'required',
            'image'=>'nullable',
            'price'=>'required',
            'date_id'=>'numeric',
        ];
    }
}
