<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactUsRequest extends FormRequest
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
     * All validation messages function
     *
     * @return array
     **/
    public function messages()
    {
        return [
            'name.required'         => trans('lang_data.requ_name'),
            'email.required'        => trans('lang_data.requ_email'),
            'email.email'           => trans('lang_data.valid_email'),
            'phone.required'        => trans('lang_data.requ_phone'),
            'company_name.required' => trans('lang_data.requ_name'),
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $input = $request->all();
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name'         => 'required|min:' . MIN_CHARACTER_LIMIT() . '|max:' . MAX_CHARACTER_LIMIT() . '',
                        'email'        => 'required|email',
                        'phone'        => 'required',
                        'company_name' => 'required|min:' . MIN_CHARACTER_LIMIT() . '|max:' . MAX_CHARACTER_LIMIT() . '',
                    ];
                }
            case 'PUT':
            case 'PATCH':
            default:break;
        }
    }
}
