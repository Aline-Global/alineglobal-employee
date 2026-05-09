<?php

use App\Http\Controllers\EmployeeProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok']));

Route::get('/', function () {
    return redirect('/admin');
});

Route::middleware(['throttle:30,1'])->group(function () {
    Route::get('/e/{slug}', [EmployeeProfileController::class, 'show'])->name('employee.public.show');
    Route::get('/e/{slug}/vcard', [EmployeeProfileController::class, 'vcard'])->name('employee.vcard');
});

Route::get('/admin/employees/{employee}/qr-download', [EmployeeProfileController::class, 'qrDownload'])
    ->middleware(['auth'])
    ->name('employee.qr.download');
