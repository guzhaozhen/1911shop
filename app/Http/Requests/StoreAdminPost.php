<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StoreAdminPost extends FormRequest
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
            'admin_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                Rule::unique('admin')->ignore(request()->id,'admin_id')
            ], 
            
        ];
    }

    public function messages()
    {
        return [
            'admin_name.regex'=>'管理员名称中文字母数字组成',
            'admin_name.unique'=>'管理员名称已存在',
            
        ];
    }

}
