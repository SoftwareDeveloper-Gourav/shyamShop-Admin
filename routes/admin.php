<?php

use Illuminate\Support\Facades\Route;

// ADMIN ROUTE 

Route::get('/admin',function (){
    return view('admin.login');
});
Route::get('/admin/dashboard',function(){
    return view('admin.dashboard.index');
});