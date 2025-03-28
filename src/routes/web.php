<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminsController;

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

Route::get('/', [AttendancesController::class, 'index']);
Route::get('/attendance', [AttendancesController::class, 'clock']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/attendance/list', [AttendancesController::class, 'attendanceRecode']);
Route::get('/attendance/id', [AttendancesController::class, 'attendanceDetails']);
Route::get('/stamp_correction_request/list', [AttendancesController::class, 'applyList']);
Route::get('/admin/attendance/list', [AdminsController::class, 'adminAttendanceListGet']);
Route::get('/admin/attendance/id', [AdminsController::class, 'adminAttendanceDetailGet']);
Route::get('/admin/staff/list', [AdminsController::class, 'adminStaffListGet']);
Route::get('/admin/attendance/staff/id', [AdminsController::class, 'adminStaffAttendanceListGet']);
Route::get('/stamp_correction_request/list', [AdminsController::class, 'adminApplyListGet']);
Route::get('/stamp_correction_request/approve', [AdminsController::class, 'adminCorrectionGet']);