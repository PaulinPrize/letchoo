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
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'type_of_cuisine' => 'required|string|max:255',
            'number_of_guests' => 'required|integer',
            'price' => 'required|integer',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'currency' => 'required',
            'date' => 'required',
            'active' => 'boolean',
            'complete' => 'boolean',
        ];
    }
}
