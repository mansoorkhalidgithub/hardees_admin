<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        ];
        if (isset($_POST['title']) && $_POST['title'] == 'Create Rider') {
            $rules += ['restaurant_id' => 'required|numeric'];
        }


        if ($this->route()->getActionMethod() == 'store') {
            $rules += ['password' => 'required|min:6'];
            $rules += ['email' => 'required|unique:users|max:255'];
            $rules += ['role' => 'required|max:15'];
        } elseif ($this->route()->getActionMethod() == 'update') {
            $rules += ['email' => Rule::unique('users')->ignore($this->id)];
        }

        return $rules;
        // print_r($rules);
        // die;
    }

    public function messages()
    {
        return [
            'restaurant_id'  => 'Please Choose Branch',
        ];
    }
}
