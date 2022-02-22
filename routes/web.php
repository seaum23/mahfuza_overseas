<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\CandidateUpdateController;
use App\Http\Controllers\Sponsor\SponsorController;
use App\Http\Controllers\Delegate\DelegateController;
use App\Http\Controllers\Layouts\DashboardController;
use App\Http\Controllers\Sponsor\SponsorVisaController;
use App\Http\Controllers\Manpower\ManpowerJobController;
use App\Http\Controllers\HumanResource\EmployeeController;
use App\Http\Controllers\Manpower\ManpowerOfficeController;
use App\Http\Controllers\WebController;

use App\Http\Controllers\Datatable\SponsorDatatableContorller;
use App\Http\Controllers\ProcessingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
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
Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::group(['middleware' => 'guest'], function () {    

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

});

Route::group(['middleware' => 'auth'], function () {
    // Route::resources([
    //     'employee' => EmployeeController::class,
    // ]);

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::post('/employee-update-fetch/{user}', [EmployeeController::class, 'update_fetch']);
    Route::post('/employee-update/{user}', [EmployeeController::class, 'update']);
    
    Route::get('/employee-show', [EmployeeController::class, 'show'])->name('employee-show');
    Route::post('/change-password', [EmployeeController::class, 'change_password'])->name('change-password');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'login']);

    Route::prefix('delegate')->group(function () {
        Route::get('/', [DelegateController::class, 'index'])->name('delegate');
        Route::post('/', [DelegateController::class, 'store']);
        Route::post('/{delegate}/update', [DelegateController::class, 'update']);
        Route::get('/list', [DelegateController::class, 'list'])->name('delegate-show');
        Route::post('/office/add/{delegate}', [DelegateController::class, 'store_new_office'])->name('delegate.office');
        Route::post('/office/destroy/{delegate_office}', [DelegateController::class, 'destroy_office']);
        Route::post('/office/update/{delegate_office}', [DelegateController::class, 'update_office']);
    });

    Route::prefix('sponsor')->group(function () {
        Route::get('/', [SponsorController::class, 'index'])->name('sponsor');
        Route::post('/', [SponsorController::class, 'store']);
        Route::post('/{sponsor}/update', [SponsorController::class, 'update']);
        Route::post('/{delegate}/fetch_delegate_office', [SponsorController::class, 'fetch_delegate_office']);
        Route::get('/list/datatable', [SponsorController::class, 'list'])->name('sponsor-list');
        Route::get('/datatable/ajax', [SponsorController::class, 'table_data']);
        Route::post('/edit.sponsor.data', [SponsorController::class, 'edit_sponsor_data']);
    });
    
    Route::resource('jobs', JobController::class);

    Route::get('/sponsor-visa.list', [SponsorVisaController::class, 'show']); // FORGOT TO USE INDEX METHOD. LAZY TO CHANGE NOW. WILL WORK ON IT LATER.
    Route::resource('sponsor-visa', SponsorVisaController::class);

    Route::resource('manpower-office', ManpowerOfficeController::class);

    Route::resource('manpower-job', ManpowerJobController::class);

    Route::get('/agent.list',[AgentController::class, 'datatable']);
    Route::resource('agent', AgentController::class);
    Route::get('agent/balance-sheet/{agent}', [AgentController::class, 'balanace_sheet']);

    Route::resource('candidate', CandidateController::class);
    Route::get('/candidate.list',[CandidateController::class, 'datatable']);
    Route::prefix('candidate')->group(function () {
        Route::get('/experienced/{id}',[CandidateController::class, 'experienced'])->name('experienced');
        Route::get('/sponsor.visa/{candidate}',[CandidateController::class, 'sponsor_visa'])->name('sponsor_visa');
        Route::post('/sponsor.visa',[CandidateController::class, 'sponsor_visa_insert'])->name('sponsor_visa');
        
        Route::post('/test.medical',[CandidateUpdateController::class, 'test_medical']);
        Route::post('/final.medical',[CandidateUpdateController::class, 'final_medical']);
        Route::post('/police.clearance',[CandidateUpdateController::class, 'police_clearance']);
        Route::post('/training.card',[CandidateUpdateController::class, 'training_card']);
        Route::post('/candidate/departure-seal/{candidate}',[CandidateUpdateController::class, 'departure_seal'])->name('departure-update-file');
        Route::post('/arrival-seal/{candidate}',[CandidateUpdateController::class, 'arrival_seal'])->name('arrival-update-file');
        Route::post('/assign.job',[CandidateUpdateController::class, 'update_job']);
        Route::post('/assign.country',[CandidateUpdateController::class, 'assign_country']);
        Route::post('/fit.unfit/{candidate}',[CandidateUpdateController::class, 'fit_unfit']);
        Route::post('/send-to-manpower',[CandidateUpdateController::class, 'send_to_manpower']);
        Route::post('/add-youtube-link',[CandidateUpdateController::class, 'add_youtube_link']);        
        Route::get('/get-division/{district}',[CandidateUpdateController::class, 'candidate_division']);        
        
    });

    Route::get('/processing.list', [ProcessingController::class, 'datatable'])->name('processing.datatable');
    Route::prefix('processing')->group(function () {
        Route::get('/', [ProcessingController::class, 'index'])->name('processing');
        Route::post('/employee_request/{processing}', [ProcessingController::class, 'employee_request']);
        Route::post('/foreign_mole/{processing}', [ProcessingController::class, 'foreign_mole']);
        Route::post('/okala_update', [ProcessingController::class, 'okala_update']);
        Route::post('/mufa_update', [ProcessingController::class, 'mufa_update']);
        Route::post('/medical_update/{processing}', [ProcessingController::class, 'medical_update']);
        Route::post('/visa_stamping_update', [ProcessingController::class, 'visa_stamping_update'])->name('visa_stamping_update');
        Route::delete('/visa_stamping_update', [ProcessingController::class, 'delete_stamping_file']);
        Route::get('/visa_stamping/{id}', [ProcessingController::class, 'visa_stamping'])->name('visa_stamping');
        Route::post('/finger_update/{processing}', [ProcessingController::class, 'finger_update']);
        Route::post('/flight_update/{processing}', [ProcessingController::class, 'flight_update']);      
        Route::post('/flight_return_update/{processing}', [ProcessingController::class, 'return_update']);          
        Route::post('/manpower_update', [ProcessingController::class, 'manpower_update']);        
        Route::post('/generate_finger_pdf/{candidate}', [ProcessingController::class, 'generate_finger_pdf']);   
        Route::post('/generate_zip/{candidate}', [ProcessingController::class, 'generate_zip']);   
             
    });

    Route::prefix('ticket')->group(function ()
    {
        Route::get('/list', [TicketController::class, 'datatable']);
        Route::get('create/{processing}', [TicketController::class, 'create'])->name('ticket');
        Route::post('/{processing}', [TicketController::class, 'store']);
        Route::get('/', [TicketController::class, 'index'])->name('ticket-index');
        Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::put('/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
    });
    

    Route::prefix('transaction')->group(function ()
    {
        Route::post('/particular', [TransactionController::class, 'get_particular'])->name('get.particular');
        Route::post('/', [TransactionController::class, 'make_transaction'])->name('transaction');
        Route::get('/specific', [FormTemplateController::class, 'transaction_template'])->name('transaction.specific');
    });


    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    /**
     * FilePond temporary file uplaod
     * 
     * @return String temporary file path
     */
    Route::post('/upload/agent-photo', [UploadController::class, 'agent_photo']);
    Route::post('/upload/candidate-photo', [UploadController::class, 'candidate_photo']);
    Route::post('/upload/processing-photo', [UploadController::class, 'processing_photo']);
    Route::post('/upload/delegate', [UploadController::class, 'delegate_files']);    
    Route::post('/upload/manpower', [UploadController::class, 'manpower_files']);    
    Route::delete('/revert', [UploadController::class, 'delete']);

    /**
     * Ajax call
     * 
     * @return JSON
     */
    Route::get('/manpower-office.fetch.form-element', [ManpowerOfficeController::class, 'fetch_form_element']); 

    /**
     * For fetching templates
     * 
     * @return HTML template
     */
    Route::get('sponsor-visa-template/{index}', [FormTemplateController::class, 'visa_form_template']);
    Route::get('candidate-experience-status/{status}', [FormTemplateController::class, 'candidate_experience_tempalte']);
    Route::get('get-manpower-office/{job}', [FormTemplateController::class, 'get_manpower_office']);
    Route::get('get-sponsor-visa-form/{idx}', [FormTemplateController::class, 'sponsor_office']);
    Route::get('get-sponsor-parent-type', [FormTemplateController::class, 'sponsor_parent_type']);
    Route::get('visa-to-sponsor', [FormTemplateController::class, 'visa_to_sponsor']);
    Route::get('candidate-to-sponsor-visa', [FormTemplateController::class, 'candidate_to_sponsor_visa']);

    Route::get('get-age', [CandidateController::class, 'get_age']);
    Route::get('get-expiry-date', [CandidateController::class, 'get_expiry']);    
    

});


// Route::get('profile', function () {
//     // Only authenticated users may enter...
// })->middleware('auth');

// Route::get('/', function () {
//     return view('templates.login');
// });



//website routes
Route::get('website', [WebController::class, 'website_backend_all_content']);
Route::post('logo-update-route', [WebController::class, 'logo_update_route']);
Route::post('front_background_image_update/{id}', [WebController::class, 'front_background_image_update']);
Route::post('brand_name_update/{id}', [WebController::class, 'brand_name_update']);
Route::post('logo_update/{id}', [WebController::class, 'logo_update']);


Route::post('add_new_package/{id}', [WebController::class, 'add_new_tourist_package']);

Route::get('package_image_headline/{id}', [WebController::class, 'package_image_headline']);
Route::post('PackageUpdate/{id}', [WebController::class, 'PackageUpdate']);
Route::post('create_package_section', [WebController::class, 'create_package_section']);
Route::get('package_section_and_all_its_packages_delete/{id}', [WebController::class, 'package_section_and_all_its_packages_delete']);
Route::post('new_package_create/{id}', [WebController::class, 'new_package_create']);
Route::post('sectionPackageUpdate/{id}', [WebController::class, 'sectionPackageUpdate']);
Route::get('sectionPackageDelete/{id}', [WebController::class, 'sectionPackageDelete']);
Route::post('update_section_serial', [WebController::class, 'update_section_serial']);








