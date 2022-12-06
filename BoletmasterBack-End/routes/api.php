<?php

use App\Http\Controllers\{AuthController, CategoryController, DashboardController, EventController, ReportController, UserController, VoucherController};
use Illuminate\Support\Facades\Route;

Route::name('auth.')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::post('user/create', [UserController::class, 'store'])->name('store');

Route::name('event.')->prefix('event')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/inicio', [EventController::class, 'inicio'])->name('inicio');
    Route::get('/{event}', [EventController::class, 'show'])->name('show');
});

Route::name('category.')->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'] )->name('logout');
    });

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/boletos', [UserController::class, 'boletos'])->name('boletos');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::put('{user}/resetpassword', [UserController::class, 'resetpassword'])->name('resetpassword');
        Route::get('/{user}/generarticket/{voucher}', [UserController::class, 'generarTicket'])->name('generarticket');
    });

    /**
     *mostrar listado de vouchers solo el mismo usuario o admins pueden ver
     */
    Route::name('voucher.')->prefix('voucher')->group(function () {
        Route::get('/{voucher}', [VoucherController::class, 'show'])->name('show');
        Route::post('/comprar', [VoucherController::class, 'store'])->name('store');
    });

    /** cosas que puede hacer un admin
     * pueden ver el listado de todos los usuarios y borrar un usuario
     * ver todas las categorias, crear, actualizar y borrar
     * crear, actualizar y borrar eventos
     */
    Route::middleware('admin')->group(function () {
        Route::name('user.')->prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/convertir', [UserController::class, 'convertir'])->name('convertir');
        });
        
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::get('/ventasdiarias', [DashboardController::class, 'ventasDiarias'])->name('ventasDiarias');
            Route::get('/ventasporeventos', [DashboardController::class, 'ventasPorEventos'])->name('ventasPorEventos');
        });
    
        Route::name('category.')->prefix('category')->group(function () {
            Route::post('/create', [CategoryController::class, 'store'])->name('create');
            Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    
        Route::name('event.')->prefix('events')->group(function () {
            Route::post('/create', [EventController::class, 'store'])->name('create');
            Route::post('/{event}', [EventController::class, 'update'])->name('update');
            Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
            Route::get('/listarAdministracion', [EventController::class, 'listarAdministracion'])->name('listarAdministracion');
        });

        Route::name('report.')->prefix('report')->group(function () {
            Route::get('/ventas', [ReportController::class, 'ventas'])->name('ventas');
        });
    });
});
