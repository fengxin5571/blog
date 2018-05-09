<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'admin_name'=>'required|min:3',
            'admin_password'=>'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'admin_name.required'=>'管理员姓名不能为空',
            'admin_password.required'=>'管理员密码不能为空'
        ];
    }
}
