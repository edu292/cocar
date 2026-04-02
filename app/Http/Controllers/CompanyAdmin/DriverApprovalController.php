<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DriverApprovalController extends Controller
{
    public function update(Request $request, User $user): RedirectResponse
    {
        if ($request->user() - company != $user.company) {
            abort(403, 'O usuário não faz parte da sua empresa.');
        }

        if ($user->role != UserRole::Driver) {
            abort(400, 'O usuário não é um motorista.');
        }

        $user->update(['status' => UserStatus::Active]);

        return back()->with('success', 'O usuário foi aprovado e já pode realizar caronas.');
    }
}
