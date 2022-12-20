<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\AdminLoginController;
use App\Http\Controllers\dashboard\BranchesController;
use App\Http\Controllers\dashboard\CouponController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\DetectionController;
use App\Http\Controllers\dashboard\DoctorController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\MajorController;
use App\Http\Controllers\dashboard\PatientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});





Route::group([ 'middleware' => 'auth:admin', 'prefix' => 'admin'],function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('patient',[PatientController::class,'index'])->name('patient.index');
    Route::get('patient/create',[PatientController::class,'create'])->name('patient.create');
    Route::post('patient',[PatientController::class,'store'])->name('patient.store');
    Route::get('patient/{patient}/edit',[PatientController::class,'edit'])->name('patient.edit');
    Route::post('patient/{id}',[PatientController::class,'update'])->name('patient.update');
    Route::delete('patient/{patient}',[PatientController::class,'destroy'])->name('patient.destroy');

    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');



    Route::get('patient/trash',[PatientController::class,'trash'])->name('patient.trash');
    Route::get('patient/restore/{id}',[PatientController::class,'restore'])->name('patient.restore');
    Route::get('patient/hard-delete/{id}',[PatientController::class,'hard_delete'])->name('patient.hard.delete');
    ////////////////////doctors/////////////////////

    Route::get('doctor',[DoctorController::class,'index'])->name('doctor.index');
    Route::get('doctor/create',[DoctorController::class,'create'])->name('doctor.create');
    Route::post('doctor',[DoctorController::class,'store'])->name('doctor.store');
    Route::get('doctor/{doctor}/edit',[DoctorController::class,'edit'])->name('doctor.edit');
    Route::post('doctor/{doctor}',[DoctorController::class,'update'])->name('doctor.update');
    Route::delete('doctor/{doctor}',[DoctorController::class,'destroy'])->name('doctor.destroy');

    Route::get('doctor/trash',[DoctorController::class,'trash'])->name('doctor.trash');
    Route::get('doctor/restore/{id}',[DoctorController::class,'restore'])->name('doctor.restore');
    Route::get('doctor/hard-delete/{id}',[DoctorController::class,'hard_delete'])->name('doctor.hard.delete');
    Route::get('doctor/days/{id}',[DoctorController::class,'doctor_days'])->name('doctor.days');
    Route::get('day/create/{id}',[DoctorController::class,'create_day'])->name('day.create');
    Route::post('day/store',[DoctorController::class,'storeday'])->name('day.store');
    Route::delete('delete/{id}',[DoctorController::class,'destroy_day'])->name('destroy.day');
    ///////////////////////////////detections////////////////////////////////

    Route::get('detetion',[DetectionController::class,'index'])->name('detetion.index');
    Route::get('detetion/create',[DetectionController::class,'create'])->name('detetion.create');
    Route::post('detetion',[DetectionController::class,'store'])->name('detetion.store');
    Route::get('detetion/{detetion}/edit',[DetectionController::class,'edit'])->name('detetion.edit');
    Route::post('detetion/{detetion}',[DetectionController::class,'update'])->name('detetion.update');
    Route::delete('detetion/{detetion}',[DetectionController::class,'destroy'])->name('detetion.destroy');

    Route::get('detetion/trash',[DetectionController::class,'trash'])->name('detetion.trash');
    Route::get('detetion/restore/{id}',[DetectionController::class,'restore'])->name('detetion.restore');
    Route::get('detetion/hard-delete/{id}',[DetectionController::class,'hard_delete'])->name('detetion.hard.delete');

    ////////////////////////////////////////Coupons/////////////////////////////////////////////////////////

    Route::get('coupons',[CouponController::class,'index'])->name('coupons.index');
    Route::get('coupons/create',[CouponController::class,'create'])->name('coupons.create');
    Route::post('coupons',[CouponController::class,'store'])->name('coupons.store');

    Route::delete('coupons/{coupons}',[CouponController::class,'destroy'])->name('coupons.destroy');



//////////////////////////////////////////

Route::get('admin',[AdminController::class,'index'])->name('admin.index');
Route::get('admin-create',[AdminController::class,'create'])->name('admin.create');
Route::post('admin',[AdminController::class,'store'])->name('admin.store');

///////////////////////////////////Branches////////////////////////////
Route::get('branches',[BranchesController::class,'index'])->name('branches.index');
    Route::get('branches/create',[BranchesController::class,'create'])->name('branches.create');
    Route::post('branches',[BranchesController::class,'store'])->name('branches.store');
    Route::get('branches/{branches}/edit',[BranchesController::class,'edit'])->name('branches.edit');
    Route::post('branches/{branches}',[BranchesController::class,'update'])->name('branches.update');
    Route::delete('branches/{branches}',[BranchesController::class,'destroy'])->name('branches.destroy');

    Route::get('branches/trash',[BranchesController::class,'trash'])->name('branches.trash');
    Route::get('branches/restore/{id}',[BranchesController::class,'restore'])->name('branches.restore');
    Route::get('branches/hard-delete/{id}',[BranchesController::class,'hard_delete'])->name('branches.hard.delete');

    //////////////////////////majors///////////////////////////////
    Route::get('major',[MajorController::class,'index'])->name('majors.index');
    Route::get('major/create',[MajorController::class,'create'])->name('majors.create');
    Route::post('major',[MajorController::class,'store'])->name('majors.store');
    Route::get('major/{major}/edit',[MajorController::class,'edit'])->name('majors.edit');
    Route::post('majors/{major}',[MajorController::class,'update'])->name('majors.update');
    Route::delete('major/{major}',[MajorController::class,'destroy'])->name('majors.destroy');
    //////////////////////////endMajors///////////////////////////////





});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





Route::group([ 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('adminlogin');
    Route::post('postlogin', [AdminLoginController::class, 'postlogin'])->name('post.login');
});
