<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class InviteMemberRequest extends FormRequest
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
            'email' => 'required|email'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'We need an Email id to send invitation',
            'email.email' => 'Can you please make sure this is a valid Email id ?'
        ];
    }
}
