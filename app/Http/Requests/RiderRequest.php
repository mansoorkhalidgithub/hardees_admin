<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RiderRequest extends FormRequest
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
            'profile' => 'mimes:jpeg,jpg,png|max:1000',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'restaurant_id' => 'required|numeric',
            // 'address' => 'required|max:255'
        ];

        if ($this->route()->getActionMethod() == 'store') {
            $rules += ['password' => 'required|min:6'];
            $rules += ['confirm_password' => 'required_with:password|same:password|min:6'];
            $rules += ['email' => 'required|unique:riders|max:255'];
            // $rules += ['role' => 'required|max:15'];
        } elseif ($this->route()->getActionMethod() == 'update') {
            $rules += ['email' => Rule::unique('riders')->ignore($this->id)];
        }
        // dd($rules);
        return $rules;
    }

    public function messages()
    {
        return [
            'restaurant_id.required'  => 'Please Choose Branch',
            'state_id.required'  => 'Please Choose State',
            'city_id.required'  => 'Please Choose City',
        ];
    }
}
