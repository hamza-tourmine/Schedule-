<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth_controller;
use App\Http\controllers\classRoomsController;
use App\Http\controllers\groupController;
use App\Http\controllers\moduleController;
use App\Http\controllers\formateurController;
use App\Http\Controllers\FormateurHasGroup;
use App\Http\Controllers\ShowGroupAffected;
use App\Http\Controllers\ShowModuleAffected;
use App\Http\Controllers\ScheduleChaqueFormateur ;
use App\Http\Controllers\forgotPassword;
use App\Http\Controllers\FormateurHasModuleController;
use App\Http\Controllers\FormateurRequestController;
use App\Http\Controllers\modelSetting;
use App\Http\Controllers\FileExcel;
use App\Http\Controllers\MailController;

use App\Http\Controllers\Schedule;
use App\Models\group;

// use App\Http\Middleware\Authenticate;
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


// retreve password  && forgot password Routes
Route::post('/forgot-password', [forgotPassword::class,'forgotPassword'])->name('forgotPassword');
// return view for forgot password page
Route::get('/forgot-password', [forgotPassword::class ,'index'])->name('ForgotPassword');
// retrve  new passeword
Route::post('/reset-Password', [forgotPassword::class, 'resetPassword'])->name('resetPassword');
// return  a view for page  that can  return view for page   change password
Route::get('/reset-password/{token}',[forgotPassword::class , 'resetPasswordView'])->name('resetPasswordView');
//login and  create an account


Route::get('/',function(){return view('auth.login');})->name('login');
Route::get('/create-account',[auth_controller::class ,'index'])->name('create-account');
Route::post('/insert',[auth_controller::class,'create_account'])->name('insert');
Route::post('/login',[auth_controller::class ,'login'])->name('login_into_account');

// for admin
Route::middleware(['auth' , 'RoutesForAdmin'])->group(function(){
    // Model Setting
    Route::get('/modele-seting',[modelSetting::class,'index'])->name('modelSetting');
    Route::post('/Model-setting', [modelSetting::class, 'createOrUpdate']);
    Route::get('/Model-values', [modelSetting::class, 'getCheckedValue']);
    // end Model Setting
    // For Accueil page
    Route::get('dashboardAdmin',function (){return view('adminDashboard.Main.Accueil'); })->name('dashboardAdmin');
    //Schedule
    Route::get('/ChaqueFormateur' ,[ScheduleChaqueFormateur::class , 'index'])->name('ChaqueFormateur');
    Route::get('/formateur-Selected/{id}', [ScheduleChaqueFormateur::class , 'SessionsForEashFormateur']);



    Route::get('/CreateEmpoi' , [Schedule::class , 'index'])->name('CreateEmploi');
    Route::get('/insertSession' , [Schedule::class , 'insertSession'])->name('insertSession');
    Route::get('/createNewSchedule' , [Schedule::class , 'createNewSchedule'])->name('createNewSchedule');
    Route::get('/toutlesEmploi',[Schedule::class , 'toutlesEmploi'])->name('toutlesEmploi');
    //end Schedule routes
    Route::get('/add-class-rooms',[classRoomsController::class,'index'])->name('add-class-rooms');
    Route::post('/insertClasses',[classRoomsController::class,'insert'])->name('insertClasses');
    Route::post('/insert-class-type',[classRoomsController::class,'insert_class_type'])->name('insert-class-type');
    Route::get('/add-class-type',[classRoomsController::class,'show_add_class_type'])->name('add-class-type');
    // delate types of classes
    Route::get('/delate-class-type',[classRoomsController::class,'Delete_Types_Of_Class'])->name('delate-class-type');
    // Delate class room
    Route::get('/delate-class',[classRoomsController::class,'Delete_Class'])->name('delate-class');
    // determine type of eash class room
    Route::get('/determine-type-class-room',[classRoomsController::class ,'indexOfDetermineTypeOfclass'])->name('determine-type-class-room');
    // insert class with his types
    Route::post('/insert-class-with-types',[classRoomsController::class , 'insertClassWithTtypes'])->name('insert-class-with-types');
    Route::get('/delateClassWithType',[classRoomsController::class , 'deleteClassWithTypes'])->name('delateClassWithType');
    Route::get('/UpdateClasses/{id}',[classRoomsController::class , 'EditClass']);
    Route::post('/UpdateClasses',[classRoomsController::class , 'updateClass'])->name('UpdateClasses');


// groups
    Route::controller(groupController::class)->group(function () {
    Route::get('/add-groups', 'index')->name('addGroups');
    Route::post('/insert-groups', 'insert_group')->name('insertGroups');
    Route::get('/delate-group','delate_group')->name('delateGrope');
    Route::get('/update-group/{id}','display_update_page');
    Route::post('/updateGroups/{id}','update')->name('updateGroups');
});

// modules
Route::controller(moduleController::class)->group(function(){
    Route::get('/add-model','index')->name('addModule');
    Route::post('/create-model','create')->name('insertmodule');
    Route::get('/delatemodule/{id}','destroy');
    Route::get('/update-module/{id}','display_update_page');
    Route::post('/update-module/{id}','update');
});

// Formateru Part
Route::controller(formateurController::class )->group(function(){
    Route::get('/add-formateur','index')->name('addFormateur');
    Route::post('/insert-formateur','create')->name('insertFormateur');
    // update formateur data from admin
    Route::get('/update-formateur/{id}','show_update_page');
    Route::post('/update-formateur/{id}','update');
    Route::get('/delete-formateur/{id}','destroy');
});

// Formateur has Groups
Route::controller(FormateurHasGroup::class)->group(function(){
    Route::match(['get', 'post'], '/formateurGroupe', [FormateurHasGroup::class, 'displaygroups'])->name('formateurGroupe');
});
// Formateur has Module
    Route::match(['get', 'post'], '/formateurModule', [FormateurHasModuleController::class, 'displaymodules'])->name('formateurModule');
    // Files excel
    Route::get('admin/uploed', [FileExcel::class, 'index'])->name('UploedFileExcelView');
    Route::post('uploed', [FileExcel::class, 'upload'])->name('UploedFileExcel');
});





// routes for  Formateur
Route::middleware(['auth','RoutesForFormateur'])->group(function(){
        // displat main page in formateur account
        Route::get('/dashboardFormateur',[formateurController::class , 'showHomepage'])->name('dashboard_formateur');
        // request Emploi
        Route::get('DemanderEmploi',[FormateurRequestController::class,'show'])->name('DemanderEmploi');
        // Route::post('DemanderEmploi',[FormateurRequestController::class,'show'])->name('DemanderEmploi');
        Route::post('submitAllData', [FormateurRequestController::class, 'submitAllData'])->name('submitAllData');
        Route::post('createRequestEmploi', [FormateurRequestController::class, 'createRequestEmploi'])->name('createRequestEmploi');
        //
        Route::get('FormateurGroupeList',[ShowGroupAffected::class,'Show']);
        Route::get('FormateurModuleList',[ShowModuleAffected::class,'Show']);


});
