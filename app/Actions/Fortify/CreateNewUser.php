<?php

namespace App\Actions\Fortify;

use App\Enums\TipoUsuario;
use App\Models\Organizacao;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                Rule::email()
                    ->rfcCompliant()
                    ->preventSpoofing(),
            ],
            'password' => $this->passwordRules(),
            'cpf' => 'required|regex:/^[0-9]{11}$/|unique:users',
        ])->validate();

        $dominio = substr(strstr($input['email'], '@'), 1);
        $organizacao = Organizacao::where('dominio_email', $dominio)->first();

        if (! $organizacao) {
            throw ValidationException::withMessages([
                'email' => ['O domínio do seu e-mail não está cadastrado em nenhuma organização parceira.'],
            ]);
        }

        return $organizacao->integrantes()->create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cpf' => $input['cpf'],
            'tipo' => TipoUsuario::Padrao,
        ]);
    }
}
