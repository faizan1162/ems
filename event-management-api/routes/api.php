<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => '/v1/admin/'], function () {
    Route::post('login', [\App\Http\Controllers\Api\Auth\AuthLoginController::class, 'login']);
});
Route::group(['prefix' => '/v1/admin/','middleware' => 'auth:api'] , function () {
    Route::post('logout',[\App\Http\Controllers\Api\Auth\AuthLoginController::class,'logout']);
    Route::get('dashboard',[\App\Http\Controllers\Api\DashboardController::class,'index']);

    Route::post('event',[\App\Http\Controllers\Api\Event\EventController::class,'store']);
    Route::post('event/participant',[\App\Http\Controllers\Api\Event\EventController::class,'addParticipant']);

    Route::get('event/{id}',[\App\Http\Controllers\Api\Event\EventController::class,'show']);
    Route::get('events',[\App\Http\Controllers\Api\Event\EventController::class,'index']);
    Route::get('event/user/details',[\App\Http\Controllers\Api\Event\EventController::class,'getEventAndUserDetails']);
    Route::get('event/{id}/participants',[\App\Http\Controllers\Api\Event\EventController::class,'getParticipants']);


    Route::get('tickets',[\App\Http\Controllers\Api\Event\TicketBookingController::class,'index']);
    Route::post('event/ticket',[\App\Http\Controllers\Api\Event\TicketBookingController::class,'store']);
    Route::get('event/{id}/ticket/bookings',[\App\Http\Controllers\Api\Event\TicketBookingController::class,'getTicketBookingsByEvent']);

});