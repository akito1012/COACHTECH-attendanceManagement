<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Clock;
use App\Models\BreakTime;

class AttendancesController extends Controller
{
    public function index() {
        return view('layouts.app');
    }
    public function clock() {
        $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
        $time = Carbon::now()->format("H:i");
        $clock_check = '';
        $break_check = '';
        return view('user.clock_register', compact('day', 'time', 'clock_check', 'break_check'));
    }
    public function clockCheck(Request $request){
        $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
        $time = Carbon::now()->format("H:i");
        $dateTime = Carbon::now();
        if(@isset($request->clock_check)){
            if($request->clock_check == 'clock_in' && $request->break_id  == ''){
                $clocks = [
                    'clock_in' => $dateTime->format('Y_m_d-H_i'),
                ];
                $clocks = Clock::create($clocks);
                $clock_id = $clocks->id;
                $clock_check = 'clock_in';
                return view('user.clock_register', compact('day', 'time', 'clock_check', 'clock_id'));
            }
            if($request->clock_check == 'clock_out'){
                $clocks = [
                    'clock_out' => $dateTime->format('Y_m_d-H_i'),
                ];
                unset($clocks['_token']);
                Clock::find($request->clock_id)->update($clocks);
                $clocks = Clock::find($request->clock_id);
                $clock_in = Carbon::parse($clocks->clock_in);
                $clock_out = Carbon::parse($clocks->clock_out);
                $diffInSeconds = $clock_in->diffInSeconds($clock_out);
                $break_time = $clocks->break_time;
                if(@isset($break_time)){
                    $diffInSeconds = $diffInSeconds - $break_time;
                }
                $clocks = ['clock_time' => $diffInSeconds];
                unset($clocks['_token']);
                Clock::find($request->clock_id)->update($clocks);
                $clock_check = 'clock_out';
                $break_check = '';
                return view('user.clock_register', compact('day', 'time', 'clock_check', 'break_check'));
            }
        }
        if(@isset($request->break_check)){
            if($request->break_check == 'break_in'){
                $break_times = [
                    'clock_id' => $request->clock_id,
                    'break_in' => $dateTime->format('Y_m_d-H_i'),
                ];
                $break_times = BreakTime::create($break_times);
                $clock_id = $break_times->clock_id;
                $break_times_id = $break_times->id;
                $break_check = 'break_in';
                $clock_check = 'OK';
                return view('user.clock_register', compact('day', 'time', 'clock_id', 'break_check', 'clock_check', 'break_times_id'));
            }
            if($request->break_check == 'break_out'){
                $break_times = ['break_out' => $dateTime->format('Y_m_d-H_i')];
                unset($break_times['_token']);
                BreakTime::find($request->break_times_id)->update($break_times);
                $break_times = BreakTime::find($request->break_times_id);
                $clock_id = $break_times->clock_id;
                $clock_check = 'clock_in';
                $break_in = Carbon::parse($break_times->break_in);
                $break_out = Carbon::parse($break_times->break_out);
                $diffInSeconds = $break_in->diffInSeconds($break_out);
                $clocks = Clock::find($clock_id);
                $break_time = $clocks->break_time;
                if(@isset($break_time)){
                    $diffInSeconds = $break_time + $diffInSeconds;
                }
                $break_time = ['break_time' => $diffInSeconds];
                unset($break_time['_token']);
                Clock::find($clock_id)->update($break_time);
                return view('user.clock_register', compact('day', 'time', 'clock_id', 'clock_check'));
            }
        }
    }
    public function attendanceRecode(){
        $clocks = Clock::all();
        return view('user.attendance_recode', compact('clocks'));
    }
    public function attendanceDetails(){
        return view('user.attendance_details');
    }
    public function applyList(){
        return view('user.apply_list');
    }
}
