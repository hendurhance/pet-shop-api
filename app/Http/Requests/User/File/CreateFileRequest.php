<?php

namespace App\Http\Requests\User\File;

use Illuminate\Foundation\Http\FormRequest;

class CreateFileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mp3,ogg,webm,webp,pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:2048',
        ];
    }
}
