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
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\DepositImportController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\CompanyController as UserCompanyController; 

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

// Employee login page
Route::get('/user/login', [LoginController::class, 'showEmployeeLoginForm'])->name('employee.login');

// Employee login submit
Route::post('/user/login', [LoginController::class, 'employeeLogin'])->name('employee.login.submit');


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
    Route::post('/users/import', [ImportController::class, 'import'])->name('users.import');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');


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

    Route::get('/deposits/import', [DepositImportController::class, 'showImportForm'])->name('deposits.import.form');
    Route::post('/deposits/import', [DepositImportController::class, 'importDeposits'])->name('deposits.import');

    Route::get('/checks/bulk-create', [AdminCheckController::class, 'bulkCreate'])->name('admin.checks.bulkCreate');
    Route::post('/checks/bulk-store', [AdminCheckController::class, 'bulkStore'])->name('admin.checks.bulkStore');
    Route::get('/checks/bulk-print/{ids}', [AdminCheckController::class, 'bulkPrint'])->name('admin.checks.bulkPrint');
    Route::get('/checks/history', [AdminCheckController::class, 'index'])->name('admin.checks.history');
    Route::delete('/checks/{id}', [AdminCheckController::class, 'destroy'])->name('admin.checks.destroy');


    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');

});


// Dashboards for Users
Route::prefix('user')->middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    Route::get('/checks/create', [UserDashboardController::class, 'createCheck'])->name('user.checks.create');
    Route::post('/checks', [UserDashboardController::class, 'storeCheck'])->name('user.checks.store');

    Route::get('/checks/history', [UserDashboardController::class, 'history'])->name('user.checks.history');

    Route::get('/companies', [UserDashboardController::class, 'companies'])->name('user.companies');
    Route::get('/companies/create', [UserCompanyController::class, 'create'])->name('user.companies.create');
    Route::post('/companies', [UserCompanyController::class, 'store'])->name('user.companies.store');

    Route::get('/deposits', [UserDashboardController::class, 'deposits'])->name('user.deposits');
    
    Route::get('/print/{check}', [UserCheckController::class, 'printCheck'])->name('user.checks.print');
    Route::get('/pdf/{check}', [CheckController::class, 'exportPdf'])->name('user.checks.pdf');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [PasswordController::class, 'update'])->name('password.update');

});
