<?php

use Illuminate\Support\Facades\Route;
use Naykel\Gotime\Facades\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

RouteBuilder::create('nav-main');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

// RouteBuilder::create('nav-admin');

// Route::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {
//     Route::view('/', '/admin.dashboard')->name('');
// });
