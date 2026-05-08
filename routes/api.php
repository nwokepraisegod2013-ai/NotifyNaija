<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/send', [NotificationController::class, 'send']);
Route::get('/notifications/{id}', [NotificationController::class, 'show']);