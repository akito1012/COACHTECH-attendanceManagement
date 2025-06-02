<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminsController;
use App\Http\Middleware\AdminApplyListMiddleware;
use App\Http\Middleware\AdminLoginMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/admin/login', [AuthController::class, 'adminLogin']);

Route::get('/', [AttendancesController::class, 'index']);
Route::get('/attendance', [AttendancesController::class, 'clock']);
Route::post('/attendance', [AttendancesController::class, 'clockCheck']);
Route::get('/attendance/list', [AttendancesController::class, 'attendanceRecode'])->name('user.attendance_recode');
Route::post('/attendance/list', [AttendancesController::class, 'attendanceRecodePost'])->name('user.attendance_recode');
Route::get('/attendance/{id}', [AttendancesController::class, 'attendanceDetail'])->name('attendance_detail');
Route::post('/attendance/{id}', [AttendancesController::class, 'attendanceDetailCreate'])->name('attendance_detail');
Route::get('/stamp_correction_request/list', [AttendancesController::class, 'applyList'])->middleware(AdminApplyListMiddleware::class);
Route::post('/stamp_correction_request/list', [AttendancesController::class, 'applyDetailPost']);

Route::get('/admin/attendance/list', [AdminsController::class, 'adminAttendanceListGet'])->name('admin.attendance_list');
Route::post('/admin/attendance/list', [AdminsController::class, 'adminAttendanceListPost'])->name('admin.attendance_list');
Route::get('/admin/staff/list', [AdminsController::class, 'adminStaffListGet']);
Route::get('/admin/attendance/staff/{id}', [AdminsController::class, 'adminStaffAttendanceListGet'])->name('admin.attendance_staff');
Route::post('/admin/attendance/staff/{id}', [AdminsController::class, 'adminStaffAttendanceListPost'])->name('admin.attendance_staff');
Route::get('/stamp_correction_request/approve/{attendance_correct_request}', [AdminsController::class, 'adminCorrectionGet'])->name('correction_request');
Route::post('/stamp_correction_request/approve/{attendance_correct_request}', [AdminsController::class, 'adminCorrectionPost'])->name('correction_request');