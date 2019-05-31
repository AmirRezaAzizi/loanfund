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
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'national' => 'nullable|max:10|persian_num',
            'mobile' => 'required|max:11|persian_num',
            'phone' => 'nullable|max:11|persian_num',
            'post' => 'nullable|max:10|persian_num'
        ];
    }
}
