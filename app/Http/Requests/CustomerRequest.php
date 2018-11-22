<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'code' => 'required|numeric|digits:4',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'national' => 'nullable|numeric|digits:10',
            'mobile' => 'required|numeric|digits:11',
            'phone' => 'nullable|numeric|digits:11',
            'post' => 'nullable|numeric'
        ];
    }
}
