<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth_controller;
use App\Http\controllers\classRoomsController;
use App\Http\controllers\groupController;
use App\Http\controllers\moduleController;
use App\Http\controllers\formateurControllrt;
use App\Http\controllers\FormateurHasGroup;
use App\Http\Controllers\Schedule;

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


Route::get('/',function(){return view('auth.login');})->name('login');
Route::get('/create-account',[auth_controller::class ,'index'])->name('create-account');
Route::post('/insert',[auth_controller::class,'create_account'])->name('insert');
Route::post('/login',[auth_controller::class ,'login'])->name('login_into_account');

Route::middleware('auth')->group(function(){
    //Schedule
    Route::get('/dashboard' , [Schedule::class , 'index'])->name('dashboard_Admin');

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

// models
Route::controller(moduleController::class)->group(function(){
    Route::get('/add-model','index')->name('addModel');
    Route::post('/create-model','create')->name('insertmodel');
    Route::get('/delatemodel/{id}','destroy');
    Route::get('/update-Model/{id}','display_update_page');
    Route::post('/update-Model/{id}','update');
});

// Formateru Part
Route::controller(formateurControllrt::class )->group(function(){
    Route::get('/add-formateur','index')->name('addFormateur');
    Route::post('/insert-formateur','create')->name('insertFormateur');

    // displat mane page in formateur account
    Route::get('/formateur','showHomepage')->name('dashboard_formateur');
    // update formateur data from admin
    Route::get('/update-formateur/{id}','show_update_page');
    Route::post('/update-formateur/{id}','update');
    Route::get('/delete-formateur/{id}','destroy');




});

// Formateur has Groups
Route::controller(FormateurHasGroup::class)->group(function(){

    //models
    Route::get('/models' , 'displaymodels')->name('selectmodels');
    //groups
    Route::get('/groups-models' , 'diesplayMyGroups')->name('mygroups');
    Route::get('/groups','displaygroups')->name('selectgroups');
    Route::post('/insertMygroups', 'insertMygroups')->name('insertMygroups');
    Route::post('/insertgroups_models','insertgroups_models')->name('insertgroups_models');
    Route::get('/insertMyModules','insertMyModules')->name('insertMyModules');
});

// formateur has model


});

