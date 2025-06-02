<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Clock;
use App\Models\BreakTime;
use App\Models\ApplyClock;
use App\Models\ApplyBreak;
use App\Http\Requests\DetailRequest;


class AdminsController extends Controller
{
    public function adminAttendanceListGet(){
        $now = Carbon::now();
        $today = Carbon::today();
        $clocks = Clock::whereDate('created_at', $today)->get();
        return view('admin.attendance_list', compact('now', 'today', 'clocks'));
    }
    public function adminAttendanceListPost(Request $request){
        if($request->has('subDay')){
            $today = Carbon::parse($request->today)->subDay(1);
            $clocks = Clock::whereDate('created_at', $today)->get();
            $now = $today;
            return view('admin.attendance_list', compact('now', 'today', 'clocks'));
        }
        elseif($request->has('addDay')){
            $today = Carbon::parse($request->today)->addDay(1);
            $clocks = Clock::whereDate('created_at', $today)->get();
            $now = $today;
            return view('admin.attendance_list', compact('now', 'today', 'clocks'));
        }
        else{
            $clocks = Clock::find($request->id);
            $breaks = BreakTime::where('clock_id', $request->id)->get();
            return view('admin.attendance_details', compact('clocks', 'breaks'));
        }
    }
    public function adminAttendanceDetailGet($id){
        $clocks = Clock::find($id);
        $breaks = BreakTime::where('clock_id', $id)->get();
        return view('admin.attendance_details', compact('clocks', 'breaks'));
    }
    public function adminStaffListGet(){
        $users = User::where('id', '!=', '1')->get();
        return view('admin.staff_list', compact('users'));
    }
    public function adminStaffAttendanceListGet($id){
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->startOfMonth()->addMonthNoOverflow()->subSecond(1);
        $user = User::find($id);
        $clocks = Clock::where('user_id', $id)->whereBetween('created_at', array($startMonth, $endMonth))->get();
        $now = Carbon::now();
        return view('admin.staff_attendance_list', compact('user', 'clocks', 'now'));
    }

    public function adminStaffAttendanceListPost(Request $request, $id){
        if($request->has('subMonth')){
            $startMonth = Carbon::parse($request->month)->subMonth()->firstOfMonth();
            $endMonth = Carbon::parse($request->month)->subMonth()->lastOfMonth();
            $user = User::find($request->user_id);
            $clocks = Clock::where('user_id', $request->user_id)->whereBetween('created_at', array($startMonth, $endMonth))->get();
            $now = Carbon::parse($request->month)->subMonth();
            return view('admin.staff_attendance_list', compact('user', 'clocks', 'now'));
        }
        elseif($request->has('addMonth')){
            $startMonth = Carbon::parse($request->month)->addMonth()->firstOfMonth();
            $endMonth = Carbon::parse($request->month)->addMonth()->lastOfMonth();
            $user = User::find($request->user_id);
            $clocks = Clock::where('user_id', $request->user_id)->whereBetween('created_at', array($startMonth, $endMonth))->get();
            $now = Carbon::parse($request->month)->addMonth();
            return view('admin.staff_attendance_list', compact('user', 'clocks', 'now'));
        }
        else{
            $clocks = Clock::find($request->id);
            $breaks = BreakTime::where('clock_id', $request->id)->get();
            return view('admin.attendance_details', compact('clocks', 'breaks'));
        }

        return back();
    }
    public function adminCorrectionGet($id){
        $clocks = ApplyClock::find($id);
        $breaks = ApplyBreak::where('apply_clock_id', $id)->get();

        return view('admin.correction', compact('clocks', 'breaks'));
    }

    public function adminCorrectionPost(DetailRequest $request){
        if(@isset($request->break_time_id)){
           $breaks = [
               'clock_id' => $request->clock_id,
               'break_in' => $request->break_in,
               'break_out' => $request->break_out,
           ];
           unset($breaks['_token']);
           BreakTime::find($request->break_time_id)->update($breaks);
           $break_in = Carbon::parse($request->break_in);
           $break_out = Carbon::parse($request->break_out);
           $break_time = $break_in->diffInSeconds($break_out);
        }
           $clocks = [
            'clock_id' => $request->clock_id,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
           ];
           unset($clocks['_token']);
           Clock::find($request->clock_id)->update($clocks);
           $clock_in = Carbon::parse($request->clock_in);
           $clock_out = Carbon::parse($request->clock_out);
           $diffInSeconds = $clock_in->diffInSeconds($clock_out);
           if(@isset($break_time)){
            $diffInSeconds = $diffInSeconds - $break_time;
           }
           $clocks = [
            'clock_time' => $diffInSeconds,
           ];
           if(@isset($break_time)){
               $clocks = [
                   'clock_time' => $diffInSeconds,
                   'break_time' => $break_time,
               ];
           }else{
               $clocks = [
                   'clock_time' => $diffInSeconds,
               ];
           }
           unset($clocks['_token']);
           Clock::find($request->clock_id)->update($clocks);
           $applyClock = [ 'correction_check' => '承認済み' ];
           unset($applyClock['_token']);
           ApplyClock::find($request->apply_clock_id)->update($applyClock);
           if(@isset($request->apply_break_id)){
                $applyBreak = [ 'correction_check' => '承認済み' ];
                unset($applyBreak['_token']);
                ApplyBreak::find($request->apply_break_id)->update($applyBreak);
           }

           $clocks = ApplyClock::where('user_id', '!=', '1')->get();
           return view('admin.apply_list', compact('clocks'));
    }
}
