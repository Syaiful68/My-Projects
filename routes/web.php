<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('active');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'Authentication']);
Route::delete('/logout', [AuthController::class, 'logout']);

Route::middleware(['active', 'roles:admin,user'])->group(function () {
    // armada
    Route::get('/armada', [ArmadaController::class, 'index'])->name('armada.index');
    Route::get('/armada/create', [ArmadaController::class, 'create']);
    Route::post('/armada', [ArmadaController::class, 'store']);
    Route::get('/armada/detail/{armada}', [ArmadaController::class, 'show']);
    Route::delete('/armada/delete/{armada}', [ArmadaController::class, 'destroy']);
    // report
    Route::get('/settings/report', [ReportController::class, 'index'])->name('report');
    Route::get('/export', [ReportController::class, 'export'])->name('export');
});
Route::middleware(['active', 'roles:admin'])->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // user
    Route::get('/settings/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/settings/user', [UserController::class, 'store']);
    Route::get('/settings/user/details/{user}', [UserController::class, 'show']);
    Route::delete('/settings/user/delete/{user}', [UserController::class, 'destroy']);
});

route::middleware(['active', 'roles:user,driver'])->group(function () {
    // fuel
    Route::get('/fuel', [RecordController::class, 'index'])->name('record');
    Route::post('/fuel', [RecordController::class, 'store']);
    Route::get('/fuel/details/{fuel}', [RecordController::class, 'show']);
});
