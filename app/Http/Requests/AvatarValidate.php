<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarValidate extends FormRequest
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
        $rules = [
            'name' => 'required|string|min:4|max:15',
            'last_name' => 'required|string|min:4|max:15',
            'email' => 'required|string|email|min:5|max:70',
        ];

        if($this->file('avatar')){
            $rules = array_merge($rules, ['avatar' => 'mimes:jpg,jpeg,png']);
        }     

        return $rules;
    }
}
