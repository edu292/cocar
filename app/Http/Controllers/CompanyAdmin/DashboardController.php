<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->company;

        $totaUsers = $company->users()->count();
        $totalDrivers = $company->users()->where('role', UserRole::Driver)->count();

        $totalPendingDrivers = $company->users()->where([
            'role' => UserRole::Driver,
            'status' => UserStatus::PendingApproval])->count();

        return view('company-admin.index', compact(
            'company',
            'totalUsers',
            'totalDrivers',
            'totalPendingDrivers'
        ));
    }
}
