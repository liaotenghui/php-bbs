<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**该类的作用是
     * 1.获取数据
     * 2.验证数据
     * 3.两个同时进行
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //返回true时，该类就可以获取并验证数据
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //填写需要验证的规则
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-l_]+$/|unique:users,name,'.Auth::id(),
            //用户名在更改的时候是唯一的，如果用户名不更改，说明数据库有这个用户名，就会提示重复，排除自己之外的用户名才可用
            // Auth::id()不包括自己的用户名
            'email' => 'required | email ' ,
            'introduction' => 'max : 80' ,
            // 'avatar'=> 'required' ,
            'avatar' => 'mimes:png,jpg,gif,jpeg|dimensions:min_width=208,min_height=208',
        ];
    }
    public function messages(){
        return [
            'name.unique' =>'用户名已被占用，请重新填写',
            'name.regex' =>'用户名只支持英文、数字、横杠和下划线。',
            'name.between' =>'用户名必须介于3 - 25个字符之间。',
            'name.required' =>'用户名不能为空',
            // 'avatar.required' =>'头像不能为空',
            'avatar.mimes' =>'头像必须是png， jpg， gif， jpeg格式的图片',
            'avatar.dimensions' =>'图片的清晰度不够，宽和高需要208px以上',
        ];
    }
}
