<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\CheckController;
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

Route::get('/', [WebController::class, 'home'])->name('home');
// Show login form
Route::get('/login', [LoginController::class, 'showLoginForm']);

// Handle login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Handle logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');

    Route::get('/companies', [AdminCompanyController::class, 'index'])->name('admin.companies');

    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('admin.deposits');

    Route::get('/checks/history', [AdminCheckController::class, 'history'])->name('admin.checks.history');

    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports');

});


// Dashboards for Users
Route::prefix('user')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/checks/create', [UserDashboardController::class, 'createCheck'])->name('user.checks.create');
    Route::post('/checks', [UserDashboardController::class, 'storeCheck'])->name('user.checks.store');

    Route::get('/checks/history', [UserDashboardController::class, 'history'])->name('user.checks.history');

    Route::get('/companies', [UserDashboardController::class, 'companies'])->name('user.companies');
    Route::get('/deposits', [UserDashboardController::class, 'deposits'])->name('user.deposits');
    
    Route::get('/print/{check}', [CheckController::class, 'printCheck'])->name('user.checks.print');
    Route::get('/pdf/{check}', [CheckController::class, 'exportPdf'])->name('user.checks.pdf');
});
