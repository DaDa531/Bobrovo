<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'test' => 'required',
            'group' => 'required',
            'available_from' => 'required|date',
            //'available_from_date' => 'required|date',
            //'available_from_time' => 'required',
            'available_to' => 'required|date',
            //'available_to_date' => 'required|date',
            //'available_to_time' => 'required',
            'time_to_do' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'test.required' => 'Musíte zvoliť test.',
            'group.required' => 'Musíte zvoliť skupinu.',
            'available_from.required' => 'Zvoľte dátum a čas začatia testu.',
            //'available_from_date.required' => 'Zvoľte dátum začatia testu.',
            //'available_from_time.required' => 'Zvoľte čas začatia testu.',
            'available_to.required' => 'Zvoľte dátum a čas ukončenia testu.',
            //'available_to_date.required' => 'Zvoľte dátum ukončenia testu.',
            //'available_to_time.required' => 'Zvoľte čas ukončenia testu.',
            'time_to_do.required' => 'Zvoľte čas dostupný na test (v minútach).'
        ];
    }
}
