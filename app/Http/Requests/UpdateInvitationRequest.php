<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvitationRequest extends FormRequest
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
            'menu' => 'required|string|max:255',
            'type_of_cuisine' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            //'currency' => 'required',
            //'tax' => 'required|numeric|min:1',
            'place' => 'required|string|max:255',
            'postal_code' => '',
            'date' => 'required',
            'heure' => '',
            'price' => 'required|numeric|min:1',
            'income' => '',
            'total' => '',
            'number_of_guests' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'boolean',
            'complete' => 'boolean',
            'direct_payment' => 'boolean',
        ];
    }
}
