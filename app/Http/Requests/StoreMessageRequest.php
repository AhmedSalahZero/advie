<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required'
        ];
    }
    public function messages()
    {
       return [
           'name.required'=>'You have to insert Your name ' ,
           'email.required'=>'you have to inesrt your email ',
           'email.email'=>'you have to insert correct email '  ,
           'subject.required'=>'you have to insert subject for your message' ,
           'message.required'=>'you have to insert your message'
       ];
    }
}
