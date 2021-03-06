<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'title' => 'required|max:255',
            'question' => 'required',
            'a' => 'required|max:255',
            'b' => 'required|max:255',
            'c' => 'required|max:255',
            'd' => 'required|max:255',
            'answer' => 'required',
            'topics' => 'required',
            'categories' => 'required'
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
            'answer.required' => 'Musíte určiť správnu odpoveď.',
            'topics.required' => 'Priraďte úlohe aspoň jednu z tém.',
            'categories.required'  => 'Zaraďte úlohu do niektorej kategórie.',
        ];
    }
}
