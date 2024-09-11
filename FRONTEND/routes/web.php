<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DirectorSedeController;
use App\Http\Controllers\VigilanteController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/superadmin', [SuperAdminController::class, 'index'])->middleware('auth:superadmin');
Route::post('/superadmin/sede', [SuperAdminController::class, 'createSede'])->middleware('auth:superadmin');
Route::post('/superadmin/director', [SuperAdminController::class, 'createDirector'])->middleware('auth:superadmin');

Route::get('/director', [DirectorSedeController::class, 'index'])->middleware('auth:director');
Route::post('/director/vigilante', [DirectorSedeController::class, 'createVigilante'])->middleware('auth:director');
