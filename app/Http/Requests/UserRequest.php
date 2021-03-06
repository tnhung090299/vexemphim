<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
        if (request()->has('newPass'))
        {
            return [
                'oldPass' => 'required',
                'newPass' => 'required|min:6',
                'rePass' => 'required|same:newPass',
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:6',
                'address' => 'required',
                'mobile' => 'required|min:10|max:15',
        ];
        }
    }
}
