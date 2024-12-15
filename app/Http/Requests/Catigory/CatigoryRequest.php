<?php

namespace App\Http\Requests\Catigory;

use Illuminate\Foundation\Http\FormRequest;

class CatigoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'catigory_name'     =>  ['required','string',],
            'color'             =>  ['required','string',],
        ];
    }
}
