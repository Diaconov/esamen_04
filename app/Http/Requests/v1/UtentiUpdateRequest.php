<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UtentiUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    //public function authorize(): bool
    //{
    //    return false;
    //}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nome" => "string|max:45",
            "cognome" => "string|max:85",
            "sesso" => "integer",
            "idStato" => "integer",
            "cittadinanza" => "string|max:45",
            "dataNascita" => "date",
            "credito" => "integer",
        ];
    }
}
