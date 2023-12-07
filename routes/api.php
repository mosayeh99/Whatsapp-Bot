<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\VerifyTokenController;
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

Route::get('/messages', [VerifyTokenController::class, 'verifyToken']);
Route::post('/messages', [MessageController::class, 'ReceivedMessage']);
