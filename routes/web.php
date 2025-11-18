<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\CheckController as UserCheckController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CheckController as AdminCheckController; 
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

    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create'); 
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/companies', [CompanyController::class, 'index'])->name('admin.companies');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('admin.companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('admin.companies.store');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('admin.companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('admin.companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('admin.companies.destroy');

    Route::get('/deposits', [DepositController::class, 'index'])->name('admin.deposits');
    Route::get('/deposits/create', [DepositController::class, 'create'])->name('admin.deposits.create');
    Route::post('/deposits', [DepositController::class, 'store'])->name('admin.deposits.store');
    Route::get('/deposits/{deposit}/edit', [DepositController::class, 'edit'])->name('admin.deposits.edit');
    Route::put('/deposits/{deposit}', [DepositController::class, 'update'])->name('admin.deposits.update');
    Route::delete('/deposits/{deposit}', [DepositController::class, 'destroy'])->name('admin.deposits.destroy');

    Route::get('/checks/history', [AdminCheckController::class, 'index'])->name('admin.checks.history');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');

});


// Dashboards for Users
Route::prefix('user')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/checks/create', [UserDashboardController::class, 'createCheck'])->name('user.checks.create');
    Route::post('/checks', [UserDashboardController::class, 'storeCheck'])->name('user.checks.store');

    Route::get('/checks/history', [UserDashboardController::class, 'history'])->name('user.checks.history');

    Route::get('/companies', [UserDashboardController::class, 'companies'])->name('user.companies');
    Route::get('/deposits', [UserDashboardController::class, 'deposits'])->name('user.deposits');
    
    Route::get('/print/{check}', [UserCheckController::class, 'printCheck'])->name('user.checks.print');
    Route::get('/pdf/{check}', [UserCheckController::class, 'exportPdf'])->name('user.checks.pdf');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return 'Cache cleared!';
});

