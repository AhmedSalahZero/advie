<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLanguageRequest extends FormRequest
{
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
            'name'=> ['required', 'regex:/^[a-zA-Z]+$/u' , 'max:255' , Rule::unique('languages')->ignore($this->route()->id) ] ,
            'code'=> ['required', 'regex:/^[a-zA-Z]+$/u' , 'max:255' , Rule::unique('languages')->ignore($this->route()->id) ] ,
            'image' => 'mimes:jpeg,jpg,png|max:100000' ,
            'active'=>'required',
        ];
    }
}
