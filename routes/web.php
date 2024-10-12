<?php

use App\Http\Controllers\BenefitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');


    Route::resource('employees', EmployeeController::class);
    Route::get('/employees/{employee_id}/leaves', [EmployeeController::class, 'leaves'])->name('employees.leaves');
    Route::get('/employees/{employee_id}/deductions', [EmployeeController::class, 'deductions'])->name('employees.deductions');
    Route::get('/employees/{employee_id}/deductions/create', [EmployeeController::class, 'deduction_create'])->name('employees.deduction-create');


    Route::post('/deductions', [DeductionController::class, 'store'])->name('deductions.store');
    Route::get('/deductions/{deduction}', [DeductionController::class, 'edit'])->name('deductions.edit');
    Route::put('/deductions/{deduction}', [DeductionController::class, 'update'])->name('deductions.update');
    Route::delete('/deductions/{deduction}', [DeductionController::class, 'destroy'])->name('deductions.destroy');

    Route::resource('leaves', LeaveController::class);
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('benefits', BenefitController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
