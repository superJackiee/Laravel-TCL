<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QrController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TankerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CheckListNrController;
use App\Http\Controllers\CheckListRigidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TCLEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! Note
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('/newhiremockup', function () {
    return view('newbooking');
});

Route::get('/checkoutmockup', function () {
    return view('checkout');
});
Route::get('/rigid', function () {
    return view('rigid');
});

Auth::routes();

Route::post('videosStore', 'App\Http\Controllers\MediaController@saveVideo')->name('videos.store');
Route::post('imagesStore', 'App\Http\Controllers\MediaController@saveImage')->name('images.store');

Route::get('contract/{uuid}', [ContractController::class, 'customerSign'])->name('contract_link');
Route::put('contract/{hire}',  [ContractController::class, 'store'])->name('contract.store');

Route::get('checkListNR/{uuid}', [ContractController::class, 'checklistNr'])->name('checklist_nr_link');
Route::get('checkListRigid/{uuid}', [ContractController::class, 'checklistRigid'])->name('checklist_rigid_link');

// Route::get('sendMail', function (Request $request) {    
//     $hire_id = $request->hire_id;
//     $hire = \App\Models\Hire::find($hire_id);
//     $details = [
//         'hirer_name' => $hire->hirer_name,
//         'link_url' => route('contract_link', ['uuid' => $hire->uuid])
//     ];

//     $email_address = $hire->company->email;

//     // \Mail::to('italexx.ua@gmail.com')->send(new \App\Mail\SendCustomerMail($details));
//     \Mail::to($email_address)->send(new \App\Mail\SendCustomerMail($details));  
    
//     return redirect()
//             ->route('hires.edit', $hire)
//             ->withSuccess(__('crud.common.email'));
// })->name('email');


Route::get('sendMail', [TCLEmailController::class, 'sendHireEmailToCustomer'])->name('email');
// Route::get('sendCheckListNRMail', [TCLEmailController::class, 'sendCheckListNRMailToCustomer'])->name('send.checklist.nr.mail');
// Route::get('sendCheckListRigidMail', [TCLEmailController::class, 'sendCheckListRigidMailToCustomer'])->name('send.checklist.rigid.mail');


Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('settings', SettingController::class);
        Route::resource('tankers', TankerController::class);
        Route::resource('qrs', QrController::class);
        Route::resource('logs', LogController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('users', UserController::class);
        Route::resource('hires', HireController::class);
        Route::resource('check-list-n-rs', CheckListNrController::class);
        Route::resource('check-list-rigids', CheckListRigidController::class);
        Route::get('link/{fleet_num}', [LinkController::class, 'showTanker']);

        Route::get('user/profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('user/avatarUpload', [ProfileController::class, 'avatarUpload'])->name('user.avatarUpload');
        Route::post('user/profileUpdate', [ProfileController::class, 'profileUpdate'])->name('user.profileUpdate');
        Route::post('user/jobInfoUpdate', [ProfileController::class, 'jobInfoUpdate'])->name('user.jobInfoUpdate');
        Route::post('user/changePwd', [ProfileController::class, 'changePwd'])->name('user.changePwd');        
        Route::post('tankers/archive', [TankerController::class, 'archive'])->name('tankers.archive');
    });

Route::get('/{any}', function(){
    return redirect()->route("welcome");
});


