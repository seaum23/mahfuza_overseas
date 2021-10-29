<?php

use App\Http\Controllers\Agent\AgentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\Sponsor\SponsorController;
use App\Http\Controllers\Delegate\DelegateController;
use App\Http\Controllers\Layouts\DashboardController;
use App\Http\Controllers\Sponsor\SponsorVisaController;
use App\Http\Controllers\HumanResource\EmployeeController;
use App\Http\Controllers\Manpower\ManpowerOfficeController;
use App\Http\Controllers\Datatable\SponsorDatatableContorller;
use App\Http\Controllers\Manpower\ManpowerJobController;
use App\Http\Controllers\UploadController;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

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
Route::get('/', [LoginController::class, 'index'])->name('login');

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
    Route::get('/delegate/list', [DelegateController::class, 'list'])->name('delegate-show');
    Route::post('/delegate/office/add/{delegate}', [DelegateController::class, 'store_new_office'])->name('delegate.office');
    Route::post('/delegate/office/destroy/{delegate_office}', [DelegateController::class, 'destroy_office']);
    Route::post('/delegate/office/update/{delegate_office}', [DelegateController::class, 'update_office']);

    Route::get('/sponsor', [SponsorController::class, 'index'])->name('sponsor');
    Route::post('/sponsor', [SponsorController::class, 'store']);
    Route::post('/sponsor/{sponsor}/update', [SponsorController::class, 'update']);
    Route::post('/sponsor/{delegate}/fetch_delegate_office', [SponsorController::class, 'fetch_delegate_office']);
    Route::get('/sponsor/list/datatable', [SponsorController::class, 'list'])->name('sponsor-list');
    Route::get('/sponsor/datatable/ajax', [SponsorController::class, 'table_data']);
    Route::post('/sponsor/edit.sponsor.data', [SponsorController::class, 'edit_sponsor_data']);
    
    Route::resource('jobs', JobController::class);

    Route::resource('sponsor-visa', SponsorVisaController::class);
    Route::get('/sponsor-visa.list', [SponsorVisaController::class, 'show']); // FORGOT TO USE INDEX METHOD. LAZY TO CHANGE NOW. WILL WORK ON IT LATER.

    Route::resource('manpower-office', ManpowerOfficeController::class);

    Route::resource('manpower-job', ManpowerJobController::class);

    Route::get('/agent.list',[AgentController::class, 'datatable']);
    Route::resource('agent', AgentController::class);

    Route::get('/candidate.list',[CandidateController::class, 'datatable']);
    Route::resource('candidate', CandidateController::class);

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::post('/upload/agent-photo', [UploadController::class, 'agent_photo']);
    Route::post('/upload/agent-passport', [UploadController::class, 'agent_passport']);
    Route::post('/upload/agent-police', [UploadController::class, 'agent_police']);
    Route::delete('/revert', [UploadController::class, 'delete']);

    /**
     * Ajax call
     * 
     * @return JSON
     */
    Route::get('/manpower-office.fetch.form-element', [ManpowerOfficeController::class, 'fetch_form_element']); 

    /**
     * For fetching templates
     */
    Route::get('sponsor-visa-template/{index}', [FormTemplateController::class, 'visa_form_template']);
    Route::get('candidate-experience-status/{status}', [FormTemplateController::class, 'candidate_experience_tempalte']);
    Route::get('get-manpower-office/{job}', [FormTemplateController::class, 'get_manpower_office']);
    

});


// Route::get('profile', function () {
//     // Only authenticated users may enter...
// })->middleware('auth');

// Route::get('/', function () {
//     return view('templates.login');
// });
