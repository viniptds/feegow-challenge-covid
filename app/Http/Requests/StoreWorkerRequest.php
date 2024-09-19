<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
{
    // protected $stopOnFirstFailure = true;

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
            'fullname' => 'string|max:150|min:3',
            'cpf' => 'string|cpf|unique:workers,cpf',
            'birthdate' => 'date|before_or_equal:' . date('Y-m-d', strtotime('now -18 year')),
            'has_comorbidity' => 'boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [

            'birthdate.before_or_equal' => 'O colaborador precisa ter pelo menos 18 anos',
            'cpf.cpf' => 'Digite um CPF válido',
            'cpf.unique' => 'O CPF informado já foi cadastrado',
        ];
    }
}
