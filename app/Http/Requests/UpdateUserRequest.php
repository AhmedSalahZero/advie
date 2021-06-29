<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'=> ['required', 'max:255' , Rule::unique('users')->ignore($this->route()->id) ] ,
            'email'=> ['required', 'max:255' , Rule::unique('users')->ignore($this->route()->id) ] ,
            'phone' => 'nullable|regex:/(01)[0-9]{9}/',
            'avatar' => 'mimes:jpg,jpeg,bmp,png'
        ];
    }
}
