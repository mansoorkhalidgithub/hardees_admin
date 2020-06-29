<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules =  [
            'phone_number' => 'required|numeric',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric',
        ];

        if ($this->route()->getActionMethod() == 'store') {
            $rules += ['password' => 'required|min:6'];
            $rules += ['email' => 'required|unique:auth|max:255'];
            $rules += ['role' => 'required|max:15'];
        } elseif ($this->route()->getActionMethod() == 'update') {
            $rules += ['email' => Rule::unique('auth')->ignore($this->id)];
        }
        // dd($rules);
        return $rules;
    }

    public function messages()
    {
        return [
            'state_id.required'  => 'Please Choose State',
            'city_id.required'  => 'Please Choose City',
        ];
    }
}
