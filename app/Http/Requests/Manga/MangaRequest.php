<?php

namespace App\Http\Requests\Manga;

use Illuminate\Foundation\Http\FormRequest;

class MangaRequest extends FormRequest
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
            'title' => ['required', 'unique:mangas', 'max:255'],
            'author' => ['required', 'max:255'],
            'image' => ['required'],
            'start_date' => ['required'],
            'tags' => ['required'],
            'categories' => ['required'],
            
        ];
    }
}
