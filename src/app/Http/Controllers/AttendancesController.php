<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendancesController extends Controller
{
    public function index() {
        return view('layouts.app');
    }
    public function clock() {
        $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
        $time = Carbon::now()->format("H:i");
        return view('user.clock_register', compact('day', 'time'));
    }
    public function attendanceRecode(){
        return view('user.attendance_recode');
    }
    public function attendanceDetails(){
        return view('user.attendance_details');
    }
    public function applyList(){
        return view('user.apply_list');
    }
}
