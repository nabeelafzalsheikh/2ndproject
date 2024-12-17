<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index($tenant)
    {
        // Get the authenticated user for the tenant
        $user = DB::table('tenant_users')->where('id', auth()->id())->first();

        return view('dashboard', compact('user'));
    }
}
