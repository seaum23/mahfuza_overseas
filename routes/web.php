<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Sponsor\SponsorController;
use App\Http\Controllers\Delegate\DelegateController;
use App\Http\Controllers\Layouts\DashboardController;
use App\Http\Controllers\HumanResource\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'guest'], function () {    

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

});

Route::group(['middleware' => 'auth'], function () {    
    // Route::resources([
    //     'employee' => EmployeeController::class,
    // ]);
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::post('/employee-update-fetch/{user}', [EmployeeController::class, 'update_fetch']);
    Route::post('/employee-update/{user}', [EmployeeController::class, 'update']);
    
    Route::get('/employee-show', [EmployeeController::class, 'show'])->name('employee-show');
    Route::post('/change-password', [EmployeeController::class, 'change_password'])->name('change-password');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'login']);

    Route::get('/delegate', [DelegateController::class, 'index'])->name('delegate');
    Route::post('/delegate', [DelegateController::class, 'store']);
    Route::post('/delegate/{delegate}/update', [DelegateController::class, 'update']);
    Route::get('/delegate-show', [DelegateController::class, 'show'])->name('delegate-show');
    Route::post('/delegate/office/add/{delegate}', [DelegateController::class, 'store_new_office'])->name('delegate.office');
    Route::post('/delegate/office/destroy/{delegate_office}', [DelegateController::class, 'destroy_office']);
    Route::post('/delegate/office/update/{delegate_office}', [DelegateController::class, 'update_office']);

    Route::get('/sponsor', [SponsorController::class, 'index'])->name('sponsor');
    Route::post('/sponsor', [SponsorController::class, 'store']);
    Route::post('/sponsor/{delegate}/fetch_delegate_office', [SponsorController::class, 'fetch_delegate_office']);

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});


// Route::get('profile', function () {
//     // Only authenticated users may enter...
// })->middleware('auth');

// Route::get('/', function () {
//     return view('templates.login');
// });
