<?php

namespace App\Actions\Fortify;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Company;
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
     * Validate and create a newly registered user.
     *
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
                Rule::email()
                    ->rfcCompliant()
                    ->preventSpoofing(),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', 'in:driver,rider'],
        ])->validate();

        $domain = substr(strstr($input['email'], '@'), 1);
        $company = Company::where('email_domain', $domain)->first();

        if (! $company) {
            throw ValidationException::withMessages([
                'email' => ['O seu domínio de email não está cadastrado com nenhuma de nossas empresas parceiras.'],
            ]);
        }

        $role = UserRole::from($input['role']);
        if ($role == UserRole::Driver) {
            $user = UserStatus::PendingApproval;
        } else {
            $user = UserStatus::Active;
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
            'company_id' => $company->id,
            'status' => $user,
        ]);
    }
}
