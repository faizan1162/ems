<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
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
Route::get('/config-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    return "Cache is cleared";
});
Route::get('/', function () {
    return view("welcome");
});