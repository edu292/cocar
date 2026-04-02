<?php

namespace App\Enums;

enum UserRole: string
{
    case CompanyAdmin = 'company_admin';
    case SystemAdmin = 'system_admin';
    case Driver = 'driver';
    case Rider = 'rider';

}
