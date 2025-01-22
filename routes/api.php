<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskApiController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\CheckInApiController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\AttendanceApiController;
use App\Http\Controllers\WaitlistController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/chat/messages', [ChatMessageController::class, 'receive']);
Route::post('/chat/messages/list', [ChatMessageController::class, 'messagesList']);


// Mobile Applications APis
// Route::post('/login', [LoginApiController::class, 'authenticate']);
// Route::post('/check-in', [CheckInApiController::class, 'checkIn'])->middleware('custom.sanctum');
// Route::post('/check-out', [CheckInApiController::class, 'checkOut'])->middleware('custom.sanctum');
// Route::post('/task', [TaskApiController::class, 'store'])->middleware('custom.sanctum');
// Route::post('/request/store', [TaskApiController::class, 'storeRequest'])->middleware('custom.sanctum');
// Route::get('/attendance', [AttendanceApiController::class, 'viewAttendance'])->middleware('auth:sanctum');
// Route::get('/requests', [TaskApiController::class, 'list'])->name('request')->middleware('custom.sanctum');

//wait list
Route::post('v1/waitlist', [WaitlistController::class, 'store']);

// Route::get('/waitlist', [WaitlistController::class, 'list']);
