<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class patientRequest extends FormRequest
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
            'age'=>'numeric|required',
            'phone'=>'required',
            'password'=>'required|min:6',
            'birth_day'=>'required|date',
            'address'=>'required',
        ];
    }
}
