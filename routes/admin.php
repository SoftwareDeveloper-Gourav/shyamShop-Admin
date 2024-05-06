<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Middleware\AdminMiddleware;

// ADMIN ROUTE 
Route::get('/admin',function (){
    return view('admin.login');
})->name('admin');
Route::post('/admin/login',[LoginController::class,'adminLogin']);  


Route::group(["middleware"=>"admin"],function(){

      Route::get('/admin/dashboard',[LoginController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[LoginController::class,'adminLogout'])->name('admin.logout');

});
