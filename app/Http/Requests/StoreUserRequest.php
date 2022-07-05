<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255|unique:users,email,',
            'telephone' => '',
            'password' => 'bail|min:8|required_with:confirmer_le_mot_de_passe|same:confirmer_le_mot_de_passe',
            'confirmer_le_mot_de_passe' => '',
        ];
    }
}
