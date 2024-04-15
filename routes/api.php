<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logins', [AuthController::class, 'logins']);


Route::middleware('auth:sanctum')->group(function () {
    //Route::post('/register', [AuthController::class, 'register']);
    //Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);});


 
Route::post('/users',[UserController::class,'store']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::get('/users',[UserController::class,'index']);
Route::put('/users/{identifier}', [UserController::class,'update']);
Route::delete('/users/{identifier}', [UserController::class,'destroy']);


Route::post('/types',[TypeController::class,'store']);
Route::get('/types/{identifier}',[TypeController::class,'show']);
Route::get('/types',[TypeController::class,'index']);
Route::put('/types/{identifier}', [TypeController::class,'update']);
Route::delete('/types/{identifier}', [TypeController::class,'destroy']);


Route::post('/stands',[StandController::class,'store']);
Route::get('/stands/{identifier}',[StandController::class,'show']);
Route::get('/stands',[StandController::class,'index']);
Route::put('/stands/{identifier}', [StandController::class,'update']);
Route::delete('/stands/{identifier}', [StandController::class,'destroy']);


Route::post('/reservations',[ReservationController::class,'store']);
Route::get('/reservations/{identifier}',[ReservationController::class,'show']);
Route::get('/reservations',[ReservationController::class,'index']);
Route::put('/reservations/{identifier}', [ReservationController::class,'update']);
Route::delete('/reservations/{identifier}', [ReservationController::class,'destroy']);


Route::post('/ratings',[RatingController::class,'store']);
Route::get('/ratings/{identifier}',[RatingController::class,'show']);
Route::get('/ratings',[RatingController::class,'index']);
Route::put('/ratings/{identifier}', [RatingController::class,'update']);
Route::delete('/ratings/{identifier}', [RatingController::class,'destroy']);


Route::post('/messages',[MessageController::class,'store']);
Route::get('/messages/{identifier}',[MessageController::class,'show']);
Route::get('/messages',[MessageController::class,'index']);
Route::put('/messages/{identifier}', [MessageController::class,'update']);
Route::delete('/messages/{identifier}', [MessageController::class,'destroy']);


Route::post('/chats',[ChatController::class,'store']);
Route::get('/chats/{identifier}',[ChatController::class,'show']);
Route::get('/chats',[ChatController::class,'index']);
Route::put('/chats/{identifier}', [ChatController::class,'update']);
Route::delete('/chats/{identifier}', [ChatController::class,'destroy']);


Route::post('/evenements',[EvenementController::class,'store']);
Route::get('/evenements/{identifier}',[EvenementController::class,'show']);
Route::get('/evenements',[EvenementController::class,'index']);
Route::put('/evenements/{identifier}', [EvenementController::class,'update']);
Route::delete('/evenements/{identifier}', [EvenementController::class,'destroy']);
Route::get('/evenements/{identifier}/date',[EvenementController::class,'showDate']);



