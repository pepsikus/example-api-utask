<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $required = 'required';
        $fields = [];

        if ($this->isMethod('post')) { // store (create) user
        //    $fields['password'] = 'required|string|min:6,max:50';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) { // update user
        //    $fields['id'] = 'required|exists:users,id';
        //    $fields['password'] = 'sometimes|string|min:6,max:50';
            $required = 'sometimes';
        }

        $fields += [
            'first_name' => $required . '|max:255',
            'last_name'  => $required . '|max:255',
            'email' => $required . '|email|unique:users,email',
            'password' => $required . '|string|min:6,max:50'
        ];

        return $fields;
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'first_name.required' => 'A first name is required',
            'last_name.required'  => 'A last name is required',
        ];
    }

}
