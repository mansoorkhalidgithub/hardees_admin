<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'slider' => 'mimes:jpeg,jpg,png|max:1000',
            'status' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'status.numeric'  => 'Please Choose Status',
        ];
    }
}
