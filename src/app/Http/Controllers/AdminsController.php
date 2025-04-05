<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function adminAttendanceListGet(){
        return view('admin.attendance_list');
    }
    public function adminAttendanceDetailGet(){
        return view('admin.attendance_details');
    }
    public function adminStaffListGet(){
        return view('admin.staff_list');
    }
    public function adminStaffAttendanceListGet(){
        return view('admin.staff_attendance_list');
    }
    public function adminApplyListGet(){
        return view('admin.apply_list');
    }
    public function adminCorrectionGet(){
        return view('admin.correction');
    }
}
