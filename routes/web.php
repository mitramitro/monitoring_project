<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DailyWorkController;
use App\Http\Controllers\DailyWorkItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\ManagementUsersController;
use App\Models\Contract;
use Illuminate\Support\Facades\Route;

//
// LOGIN
//
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

//
// ROUTE YANG HANYA BOLEH DIAKSES USER LOGIN NORMAL (BUKAN ROLE DISPLAY)
//
Route::middleware(['auth'])->group(function () {

    Route::resource('/dashboard', DashboardController::class);

    // Daily Work Item
    Route::get('/daily-work-item/{dailyWork}', [DailyWorkItemController::class, 'index'])
        ->name('daily-work-item.index');
    Route::post('/daily-work-item/{dailyWork}/{dailyWorkItem}/approve', [DailyWorkItemController::class, 'approve'])
        ->name('daily-work-item.approve');

    Route::get('daily-work-item/{dailyWork}/create', [DailyWorkItemController::class, 'create'])
        ->name('daily-work-item.create');
    Route::post('daily-work-item/{dailyWork}', [DailyWorkItemController::class, 'store'])
        ->name('daily-work-item.store');

    Route::get('daily-work-item/{dailyWork}/{dailyWorkItem}/edit', [DailyWorkItemController::class, 'edit'])
        ->name('daily-work-item.edit');
    Route::put('daily-work-item/{dailyWork}/{dailyWorkItem}', [DailyWorkItemController::class, 'update'])
        ->name('daily-work-item.update');
    Route::delete('daily-work-item/{dailyWork}/{dailyWorkItem}', [DailyWorkItemController::class, 'destroy'])
        ->name('daily-work-item.destroy');

    Route::resource('daily-work', DailyWorkController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('contracts', \App\Http\Controllers\ContractController::class);

    // Management User
    Route::controller(ManagementUsersController::class)->group(function () {
        Route::get('/management-users/gantiPassword/{id}', 'getGantiPassword')
            ->name('management-users.getGantiPassword');
        Route::post('/management-users/gantiPassword', 'postGantiPassword')
            ->name('management-users.postGantiPassword');
    });

    Route::resource('management-users', ManagementUsersController::class);
});

//
// ROUTE UNTUK DISPLAY SAJA (ROLE = display)
//
Route::get('/display/login', [AuthenticatedSessionController::class, 'create'])
    ->name('display.login');
Route::prefix('display')
    ->middleware(['auth', 'displayOnly'])
    ->group(function () {
        Route::get('/', [DisplayController::class, 'display'])->name('display');
        Route::get('/map', [DisplayController::class, 'map'])->name('display.map');
    });
// Route::middleware(['auth', 'displayOnly'])
//     ->get('/display', [DisplayController::class, 'display'])
//     ->name('display');
// Route::middleware(['auth', 'displayOnly'])
//     ->get('/display/map', [DisplayController::class, 'map'])
//     ->name('display.map');

// Route::middleware(['auth', 'displayOnly'])
//     ->get(
//         '/display/api/contract-locations',
//         [DisplayController::class, 'getContractLocations']
//     )
//     ->name('display.contract.locations');

require __DIR__ . '/auth.php';
