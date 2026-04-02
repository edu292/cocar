<?php

namespace App\Actions\Fortify;

use App\Enums\PapelUsuario;
use App\Enums\StatusUsuario;
use App\Models\Empresa;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
                Rule::email()->rfcCompliant()->preventSpoofing(),
            ],
            'password' => $this->passwordRules(),
            'papel' => ['required', 'string', 'in:motorista,passageiro'],
        ])->validate();

        $dominio = substr(strstr($input['email'], '@'), 1);
        $empresa = Empresa::where('dominio_email', $dominio)->first();

        if (! $empresa) {
            throw ValidationException::withMessages([
                'email' => ['O domínio do seu e-mail não está cadastrado em nenhuma empresa parceira.'],
            ]);
        }

        $papel = PapelUsuario::from($input['papel']);
        $status = $papel === PapelUsuario::Motorista
            ? StatusUsuario::PendenteAprovacao
            : StatusUsuario::Ativo;

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'papel' => $papel,
            'empresa_id' => $empresa->id,
            'status' => $status,
        ]);
    }
}
