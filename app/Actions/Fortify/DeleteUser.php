<?php

namespace App\Actions\Fortify;

use App\Models\User;

class DeleteUser
{
    public function delete(User $user): void
    {
        $user->delete();
        auth->logout();
    }
}
