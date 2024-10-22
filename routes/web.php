<?php

use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLeaveInformationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PositionController;
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
    Route::get('/employees/{employee_id}/leaves/information/create', [EmployeeLeaveInformationController::class, 'create'])->name('employees.leave-information-create');
    Route::post('/employees/{employee_id}/leaves/information', [EmployeeLeaveInformationController::class, 'store'])->name('employees.leave-information-store');
    Route::get('/employees/{employee_id}/leaves/information/{leave_information_id}/edit', [EmployeeLeaveInformationController::class, 'edit'])->name('employees.leave-information-edit');
    Route::put('/employees/{employee_id}/leaves/information/{leave_information_id}', [EmployeeLeaveInformationController::class, 'update'])->name('employees.leave-information-update');
    Route::delete('/employees/{employee_id}/leaves/information/{leave_information_id}', [EmployeeLeaveInformationController::class, 'destroy'])->name('employees.leave-information-delete');


    Route::post('/deductions', [DeductionController::class, 'store'])->name('deductions.store');
    Route::get('/deductions/{deduction}', [DeductionController::class, 'edit'])->name('deductions.edit');
    Route::put('/deductions/{deduction}', [DeductionController::class, 'update'])->name('deductions.update');
    Route::delete('/deductions/{deduction}', [DeductionController::class, 'destroy'])->name('deductions.destroy');

    Route::resource('leaves', LeaveController::class);
    Route::get('/leaves/{leave}/cancel', [LeaveController::class, 'cancelPage'])->name('leaves.cancel-page');
    Route::patch('/leaves/{leave}/cancel', [LeaveController::class, 'cancelOperation'])->name('leaves.cancel-operation');
    Route::patch('/leaves/{leave}/approve', [LeaveController::class, 'approveOperation'])->name('leaves.approve-operation');
    Route::resource('leave-types', LeaveTypeController::class);
    Route::resource('benefits', BenefitController::class);
    Route::resource('overtimes', OvertimeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('positions', PositionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
