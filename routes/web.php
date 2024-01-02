<?php

use App\Models\Role;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// Superadmin Dashboard
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
});

// Admin Dashboard
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Staff Dashboard
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
});

// Student Dashboard
Route::middleware(['auth', 'role:Student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    Route::get('/superadmin/view-students', [SuperAdminController::class, 'viewStudents'])->name('superadmin.view-students');
    Route::get('/superadmin/view-admins', [SuperAdminController::class, 'viewAdmins'])->name('superadmin.view-admins');
    Route::get('/superadmin/view-staff', [SuperAdminController::class, 'viewStaff'])->name('superadmin.view-staff');
    Route::get('/superadmin/add-user', [SuperAdminController::class, 'showAddUser'])->name('superadmin.add-user');
    Route::post('/superadmin/add-user', [SuperAdminController::class, 'addUser']);
    Route::get('/superadmin/edit-user/{id}', [SuperAdminController::class, 'editUser'])->name('superadmin.edit-user');
    Route::post('/superadmin/update-edited-user/{id}', [SuperAdminController::class, 'updateEditedUser'])->name('superadmin.update-edited-user');
});


Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/staff/view-students', [StaffController::class, 'viewStudents'])->name('staff.view-students');
    Route::get('/staff/add-student', [StaffController::class, 'showAddStudent'])->name('staff.add-student');
    Route::post('/staff/add-student', [StaffController::class, 'addStudent']);
    Route::get('/staff/edit-student/{id}', [StaffController::class, 'editStudent'])->name('staff.edit-student');
    Route::post('/staff/update-edited-student/{id}', [StaffController::class, 'updateEditedStudent'])->name('staff.update-edited-student');
    Route::get('/staff/clearance-requests', [StaffController::class, 'viewClearanceRequests'])
        ->name('staff.clearance-requests');
    Route::get('/staff/view-data/{user_id}/{unit_id}', [StaffController::class, 'viewData'])->name('staff.view-data');
    Route::get('/staff/clearance-requests/{status}', [StaffController::class, 'viewHistory'])
        ->name('staff.clearance-history');
    Route::post('/staff/clearance-requests/{id}/approve', [StaffController::class, 'approveClearance'])
        ->name('staff.approve-clearance');
    Route::get('/staff/reject-clearance/{id}', [StaffController::class, 'showRejectionForm'])->name('staff.reject-clearance');
    Route::post('/staff/submit-rejection/{id}', [StaffController::class, 'submitRejection'])->name('staff.submit-rejection');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/clearance-requests', [AdminController::class, 'viewClearanceRequests'])
        ->name('admin.clearance-requests');
    Route::get('/admin/view-data/{user_id}/{unit_id}', [AdminController::class, 'viewData'])->name('admin.view-data');
    Route::get('/admin/clearance-requests/{status}', [AdminController::class, 'viewHistory'])
        ->name('admin.clearance-history');
    Route::post('/admin/clearance-requests/{id}/approve', [AdminController::class, 'approveClearance'])
        ->name('admin.approve-clearance');
    Route::get('/admin/reject-clearance/{id}', [AdminController::class, 'showRejectionForm'])->name('admin.reject-clearance');
    Route::post('/admin/submit-rejection/{id}', [AdminController::class, 'submitRejection'])->name('admin.submit-rejection');     
});

Route::middleware(['auth', 'role:Student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/clearance-phase', [StudentController::class, 'clearancePhases'])
        ->name('student.clearance-phase');
    Route::get('/student/approved-phases', [StudentController::class, 'approvedPhases'])
        ->name('student.approved-phases');
    Route::get('/student/view-data/{user_id}', [StudentController::class, 'allSubmittedData'])
        ->name('student.view-data');
    Route::post('/student/department', [StudentController::class, 'submitDepartmentData'])->name('student.department');
    Route::post('/student/library', [StudentController::class, 'submitLibraryData'])
        ->name('student.library');
    Route::post('/student/ict-center', [StudentController::class, 'submitICTCenterData'])
        ->name('student.ict-center');
    Route::post('/student/guidance', [StudentController::class, 'submitGuidanceData'])
        ->name('student.guidance');
    Route::post('/student/student-affairs', [StudentController::class, 'submitStudentAffairsData'])
        ->name('student.student-affairs');
    Route::post('/student/bursary', [StudentController::class, 'submitBursaryData'])
        ->name('student.bursary');
    Route::post('/student/request-result', [StudentController::class, 'requestResult'])
        ->name('student.request-result');
    Route::get('/student/clearance-requests/{status}', [StudentController::class, 'viewHistory'])
        ->name('student.clearance-history');
});

require __DIR__.'/auth.php';