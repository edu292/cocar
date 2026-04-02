<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CompanyRegistrationController extends Controller
{
    public function create(): View
    {
        return view('auth.register-company');
    }

    public function store(Request $request): Redirect
    {
        $validated = $request->validate([
            'company-name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'string', 'max:14', 'unique:companies'],
            'email-domain' => ['required', 'string', 'max:255', 'unique:companies'],

            'admin-name' => ['required', 'string', 'max:255'],
            'admin-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string',  'max:255', 'confirmed'],
        ]);

        $admin = DB::transaction(function () use ($validated) {
            $company = Company::create([
                'name' => $validated['company-name'],
                'cnpj' => $validated['cnpj'],
                'email-domain' => $validated['email-domain'],
            ]);

            $user = User::create([
                'name' => $validated['admin-name'],
                'email' => $validated['admin-email'],
                'password' => Hash::make($validated['password']),
                'company_id' => $company->id,
                'role' => UserRole::CompanyAdmin,
                'status' => UserStatus::Active,
            ]);

            return $user;
        });

        Auth::login($admin);

        return redirect()->route('company-admin.index');
    }
}
