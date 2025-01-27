<?php

use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [siteController::class,'home']);
Route::get('/events', [siteController::class,'events']);
Route::get('/organizers', [siteController::class,'organizers']);
Route::get('/login', [siteController::class,'login']);
Route::get('/signup', [siteController::class,'signup']);
Route::get('/create-event', [siteController::class,'create_event']);
Route::get('/client-dashboard', function () {
    return view('dashboard');
});
Route::get('/profile', function () {
    return view('profile');
});
