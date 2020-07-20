<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateDiffCalcRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sDate' => 'required|date',
            'eDate' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'sDate.required' => 'Please provide start date!',
            'eDate.required' => 'Please provide end date!'
        ];
    }
}
