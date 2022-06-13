<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'min:1', 'exists:categories,id'],
			'title' => ['required', 'string', 'min:5', 'max:250'],
            'author' => ['required', 'string', 'min:2', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:png,jpg'],
            'status' => ['required', 'string', 'min:5', 'max:7'],
            'description' => ['nullable', 'string'],
            'only_admin' => ['nullable', 'boolean']
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Вы не заполнили поле :attribute'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'наименование',
        ];
    }

}
