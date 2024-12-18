<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Database\Models\Tenant;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['tenant'])->group(function () {
    Route::get('/{tenant}/dashboard', [DashboardController::class, 'index']);
});


Route::middleware(['tenant'])->group(function () {
    Route::get('/{tenant}/login', function () {
        return view('tenant.login');
    })->name('tenant.login');

    Route::post('/{tenant}/login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('tenant')->attempt($credentials)) {
            return redirect()->route('tenant.dashboard', ['tenant' => $request->tenant]);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    });

    Route::get('/{tenant}/dashboard', function () {
        return 'Welcome to tenant dashboard';
    })->name('tenant.dashboard')->middleware('auth:tenant');
});



Route::get('users/{id}', function($id) {
    echo $id;
});
