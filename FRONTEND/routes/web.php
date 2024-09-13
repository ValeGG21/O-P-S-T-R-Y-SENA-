<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorSedeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->withoutMiddleware([RoleMiddleware::class]);
Route::post('/login', [AuthController::class, 'login'])->name('loginPost')->withoutMiddleware([RoleMiddleware::class]);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['role:SuperAdmin'])->group(function () {
    Route::get('/superAdmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::post('/superAdmin/createSede', [SuperAdminController::class, 'createSede'])->name('superadmin.createSede');
    Route::post('/superAdmin/updateSede/{id}', [SuperAdminController::class, 'updateSede'])->name('superadmin.updateSede');
    Route::get('/superAdmin/deleteSede/{id}', [SuperAdminController::class, 'deleteSede'])->name('superadmin.deleteSede');
    Route::post('/superAdmin/createDirectorSede', [SuperAdminController::class, 'createDirectorSede'])->name('superadmin.createDirectorSede');
    Route::post('/superAdmin/updateDirectorSede/{id}', [SuperAdminController::class, 'updateDirectorSede'])->name('superadmin.updateDirectorSede');
    Route::get('/superAdmin/deleteDirectorSede/{id}', [SuperAdminController::class, 'deleteDirectorSede'])->name('superadmin.deleteSede');
});

Route::middleware(['role:DirectorSede'])->group(function () {
    Route::get('/director', [DirectorSedeController::class, 'index'])->name('director.index');
    Route::post('/director/createVigilante', [DirectorSedeController::class, 'createVigilante'])->name('director.createVigilante');
    Route::post('/director/updateVigilante/{id}', [DirectorSedeController::class, 'updateVigilante'])->name('director.updateVigilante');
    Route::delete('/director/deleteVigilante/{id}', [DirectorSedeController::class, 'deleteVigilante'])->name('director.deleteVigilante');
    Route::post('/director/createUsuarioComun', [DirectorSedeController::class, 'createUsuarioComun'])->name('director.createUsuarioComun');
    Route::post('/director/updateUsuarioComun/{id}', [DirectorSedeController::class, 'updateUsuarioComun'])->name('director.updateUsuarioComun');
    Route::delete('/director/deleteUsuarioComun/{id}', [DirectorSedeController::class, 'deleteUsuarioComun'])->name('director.deleteUsuarioComun');
});

Route::middleware(['role:Vigilante'])->group(function () {
    Route::get('/vigilante', [VigilanteController::class, 'index'])->name('vigilante.index');
    Route::post('/vigilante/CreateUsuario', [VigilanteController::class, 'createUsuarioComun'])->name('vigilante.createUsuario');
    Route::post('/vigilante/CreateRegistro', [VigilanteController::class, 'createRegistro'])->name('vigilante.createRegistro');
    Route::post('/vigilante/Check', [VigilanteController::class, 'check'])->name('vigilante.check');
});

Route::middleware(['role:UsuarioComun'])->group(function () {
    Route::get('/Inicio', [UsuarioController::class, 'index'])->name('usuario.index');
});