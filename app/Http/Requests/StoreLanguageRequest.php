<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
            'name'=> 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:languages,name,',
            'code'=> 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:languages,code',
            'image' => 'mimes:jpeg,jpg,png|required|max:100000' ,
            'active'=>'required',
        ];
    }
}
