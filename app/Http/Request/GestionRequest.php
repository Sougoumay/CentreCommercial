<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class GestionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'string|required|min:3',
            'email'=>'string|required',
            'admin'=>'boolean|required',
            'boutique'=>'string|required|min:3',
            'status'=>'string|required|min:3',
            'image'=>'image|required',
            'description'=>'string|required|min:10|max:100'
        ];
    }
}
