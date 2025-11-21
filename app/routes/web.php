<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\CollectFeesController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ManualReceiptController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\TeacherController;
use App\Models\SchoolClass;

Route::get('/', function () {
    return redirect()->route('admin.login');
    // return view('home');
});

// Admin Guest Routes (Login)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::middleware(['guest:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AuthController::class, 'adminLogin'])->name('login');
    Route::post('/', [AuthController::class, 'adminCheck'])->name('auth.check');
});

// Admin Authenticated Routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('auth.logout');

    // Student Management
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/search-parents', [StudentController::class, 'searchParents'])->name('search.parents');
        Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    });

    // Teachers Management
    Route::resource('teachers', TeacherController::class);

    Route::get('/parents/{id}/details-with-siblings', [StudentController::class, 'getParentDetailsWithSiblings'])->name('admin.parents.details.with.siblings');

    // School Profile
    Route::get('/school-profile', [SchoolController::class, 'edit'])->name('school.edit');
    Route::put('/school-profile', [SchoolController::class, 'update'])->name('school.update');

    // Academic Year Management
    Route::resource('academic-years', AcademicYearController::class);

    // School Class Management
    Route::get('/classes/{id}/sections', [SchoolClassController::class, 'getSections'])->name('classes.getSections');
    Route::resource('classes', SchoolClassController::class);

    // Section Management
    Route::resource('sections', SectionController::class);

    // Parent Management
    Route::resource('parents', ParentController::class);

    // Attendance Management
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get('/', [TeacherAttendanceController::class, 'index'])->name('index');
            Route::post('/', [TeacherAttendanceController::class, 'store'])->name('store');
            Route::delete('/{id}', [TeacherAttendanceController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('students')->name('students.')->group(function () {
            Route::get('/', [StudentAttendanceController::class, 'index'])->name('index');
            Route::post('/', [StudentAttendanceController::class, 'store'])->name('store');
            Route::delete('/{id}', [StudentAttendanceController::class, 'destroy'])->name('destroy');
        });
    });

    // Fee Management
    Route::resource('fees', FeeController::class);

    // Collect Fees
    Route::get('/collect-fees', [CollectFeesController::class, 'index'])->name('collect.fees.index');
    Route::get('/collect-fees/get-students', [CollectFeesController::class, 'getStudents'])->name('collect-fees.getStudents');
    Route::get('/collect-fees/show/{student}', [CollectFeesController::class, 'show'])->name('collect-fees.show');
    Route::post('/collect-fees/{student}/pay/{fee}', [CollectFeesController::class, 'storePayment'])->name('collect-fees.storePayment');
    Route::get('/collect-fees/{student}/print/{fee}', [CollectFeesController::class, 'printReceipt'])->name('collect-fees.printReceipt');
    Route::post('/collect-fees/bulk/{student}', [CollectFeesController::class, 'storeBulkPayment'])->name('collect-fees.storeBulkPayment');
    Route::get('/collect-fees/{student}/print-all', [CollectFeesController::class, 'printAllReceipts'])->name('collect-fees.printAllReceipts');
    Route::get('/collect-fees/{student}/send-email', [CollectFeesController::class, 'sendAllReceipts'])->name('collect-fees.sendAllReceipts');


    Route::get('/manual-receipts', [ManualReceiptController::class, 'create'])->name('manual-receipts.index');
    Route::post('/manual-receipts', [ManualReceiptController::class, 'generate'])->name('manual-receipts.generate');
});
