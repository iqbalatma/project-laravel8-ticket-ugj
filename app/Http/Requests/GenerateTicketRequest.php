<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateTicketRequest extends FormRequest
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
            'phase_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1|max:1000',
        ];
    }
    
    public function messages()
    {
        return [
            'phase_id.required' => "You have to chose the phase",
        ];
    }
}
