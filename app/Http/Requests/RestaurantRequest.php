<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            // 'name' => 'required|unique:restaurants|max:255',
            'address' => 'required',
            'region_id' => 'required',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ];

        if ($this->route()->getActionMethod() == 'store') {
            $rules += ['password' => 'required|min:6'];
            $rules += ['email' => 'required|unique:restaurants|max:255'];
            $rules += ['name' => 'required|unique:restaurants|max:255'];
            // $rules += ['logo' => 'image|mimes:jpeg,png,jpg,gif,svg|required|max:2048'];
            // $rules += ['cover' => 'image|mimes:jpeg,png,jpg,gif,svg|required|max:2048'];
        } elseif ($this->route()->getActionMethod() == 'update') {
            $rules += ['name' => Rule::unique('restaurants')->ignore($this->id)];
            $rules += ['email' => Rule::unique('restaurants')->ignore($this->id)];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'region_id.required'  => 'Please Choose Region',
            'state_id.required'  => 'Please Choose State',
            'city_id.required'  => 'Please Choose City',
        ];
    }
}
