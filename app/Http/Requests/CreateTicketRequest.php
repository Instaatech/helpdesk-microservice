<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            'title' => ['required','string'],
            'description' => ['required'],
            'category_id' => ['required','exists:categories,id'],
            'priority' => ['required','string','in:high,low,medium'],
            'attachments' => ['nullable','array','min:1'],
            'attachments.*' => ['file','mimes:jpeg,jpg,png,gif,bmp','image'],     
        ];
    }
}
