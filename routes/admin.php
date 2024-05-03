<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

// ADMIN ROUTE 

Route::get('/admin',function (){
    return view('admin.login');
});
Route::get('/admin/dashboard',function(){
    return view('admin.dashboard.index');
});
Route::post('/admin/login',[LoginController::class,'adminLogin']);  