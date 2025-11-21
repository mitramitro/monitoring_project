<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DailyWorkController;
use App\Http\Controllers\DailyWorkItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\ManagementUsersController;
use App\Mail\TestEmail;
use App\Models\DailyWorkItem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

// Route::get('/send-test-email', function () {
//     $details = [
//         'name' => 'Sugeng',
//         'message' => 'Halo! Ini email percobaan yang dikirim menggunakan SMTP Hostinger di Laravel 12 🚀',
//     ];

//     Mail::to('sugeng.wanantara@gmail.com')->send(new TestEmail($details));

//     return 'Email berhasil dikirim!';
// });

Route::middleware('auth')->group(function () {





    Route::resource('/dashboard', DashboardController::class);
    Route::get('/daily-work-item/{dailyWork}', [DailyWorkItemController::class, 'index'])->name('daily-work-item.index');
    Route::post('/daily-work-item/{dailyWork}/{dailyWorkItem}/approve', [DailyWorkItemController::class, 'approve'])->name('daily-work-item.approve');
    Route::get('daily-work-item/{dailyWork}/create', [DailyWorkItemController::class, 'create'])->name('daily-work-item.create');
    Route::post('daily-work-item/{dailyWork}', [DailyWorkItemController::class, 'store'])->name('daily-work-item.store');
    Route::get('daily-work-item/{dailyWork}/{dailyWorkItem}/edit', [DailyWorkItemController::class, 'edit'])->name('daily-work-item.edit');
    Route::put('daily-work-item/{dailyWork}/{dailyWorkItem}', [DailyWorkItemController::class, 'update'])->name('daily-work-item.update');
    Route::delete('daily-work-item/{dailyWork}/{dailyWorkItem}', [DailyWorkItemController::class, 'destroy'])->name('daily-work-item.destroy');
    Route::resource('daily-work', DailyWorkController::class);
    Route::get('/display', [DisplayController::class, 'display'])->name('display');
    // Route::middleware(['auth', 'role:display'])->group(function () {
    // Route::get('/display', [DisplayController::class, 'display'])->name('display');
});
// Management User
Route::controller(ManagementUsersController::class)->group(function () {
    Route::get('/management-users/gantiPassword/{id}', 'getGantiPassword')
        ->name('management-users.getGantiPassword');
    Route::post('/management-users/gantiPassword', 'postGantiPassword')
        ->name('management-users.postGantiPassword');
});
Route::resource('management-users', ManagementUsersController::class);


require __DIR__ . '/auth.php';
