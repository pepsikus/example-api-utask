<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            $fields['user_id'] = 'required|exists:users,id';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) { // update user
            $required = 'sometimes';
        }

        $fields = array_merge($fields, [
            'name' => $required . '|max:255',
            'description'  => $required . '|max:1024',
            'completed_at' => 'sometimes|date'
        ]);

        return $fields;
    }

}
