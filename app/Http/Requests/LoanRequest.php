<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'total' => 'required|numeric',
            'monthly' => 'required|numeric',
            'total_number' => 'required|numeric',
            'created_date' => 'required|date_format:Y-m-d',
            'closed_date' => 'nullable|date_format:Y-m-d',
        ];
    }
}
