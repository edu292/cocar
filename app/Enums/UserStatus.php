<?php

namespace App\Enums;

enum UserStatus: string
{
    case PendingApproval = 'pending_approval';
    case Active = 'active';
}
