<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Clock;
use App\Models\BreakTime;
use App\Models\ApplyClock;
use App\Models\ApplyBreak;
use App\Http\Requests\DetailRequest;

class AttendancesController extends Controller
{
    public function index() {
        return view('login');
    }
    public function clock() {
        $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
        $time = Carbon::now()->format("H:i");
        $clock_check = '';
        $break_check = '';
        return view('clock_register', compact('day', 'time', 'clock_check', 'break_check'));
    }
    public function clockCheck(Request $request){
        $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
        $time = Carbon::now()->format("H:i");
        $dateTime = Carbon::now();
        if(@isset($request->clock_check)){
            if($request->clock_check == 'clock_in' && $request->break_id  == ''){
                $clocks = ['clock_in' => $dateTime];
                $clocks = Clock::create($clocks);
                $clock_id = $clocks->id;
                $clock_check = 'clock_in';
                return view('clock_register', compact('day', 'time', 'clock_check', 'clock_id'));
            }
            if($request->clock_check == 'clock_out'){
                $clocks = ['clock_out' => $dateTime];
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
                return view('clock_register', compact('day', 'time', 'clock_check', 'break_check'));
            }
        }
        if(@isset($request->break_check)){
            if($request->break_check == 'break_in'){
                $break_times = [
                    'clock_id' => $request->clock_id,
                    'break_in' => $dateTime,
                ];
                $break_times = BreakTime::create($break_times);
                $clock_id = $break_times->clock_id;
                $break_times_id = $break_times->id;
                $break_check = 'break_in';
                $clock_check = 'OK';
                return view('clock_register', compact('day', 'time', 'clock_id', 'break_check', 'clock_check', 'break_times_id'));
            }
            if($request->break_check == 'break_out'){
                $break_times = ['break_out' => $dateTime];
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
                return view('clock_register', compact('day', 'time', 'clock_id', 'clock_check'));
            }
        }
    }
    public function attendanceRecode(){
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->startOfMonth()->addMonthNoOverflow()->subSecond(1);
        $clocks = Clock::whereBetween('created_at', array($startMonth, $endMonth))->get();
        $now = Carbon::now();
        return view('attendance_recode', compact('clocks', 'now'));
    }
    public function attendanceRecodePost(Request $request){
        if($request->has('subMonth')){
            $startMonth = Carbon::parse($request->month)->subMonth()->firstOfMonth();
            $endMonth = Carbon::parse($request->month)->subMonth()->lastOfMonth();
            $clocks = Clock::whereBetween('created_at', array($startMonth, $endMonth))->get();
            $now = Carbon::parse($request->month)->subMonth();
            return view('attendance_recode', compact('clocks', 'now'));
        }
        elseif($request->has('addMonth')){
            $startMonth = Carbon::parse($request->month)->addMonth()->firstOfMonth();
            $endMonth = Carbon::parse($request->month)->addMonth()->lastOfMonth();
            $clocks = Clock::whereBetween('created_at', array($startMonth, $endMonth))->get();
            $now = Carbon::parse($request->month)->addMonth();
            return view('attendance_recode', compact('clocks', 'now'));
        }

        return back();
    }
    public function applyList(){
        $auth = Auth::id();
        $clocks = ApplyClock::where('user_id', $auth)->where('correction_check', '承認待ち')->get();
        return view('apply_list', compact('clocks'));
    }

    public function applyDetailPost(Request $request) {
        $auth = Auth::id();
        if($request->has('承認待ち')){
            $clocks = ApplyClock::where('user_id', $auth)->where('correction_check', '承認待ち')->get();
            return view('apply_list', compact('clocks'));
        }elseif($request->has('承認済み')){
            $clocks = ApplyClock::where('user_id', $auth)->where('correction_check', '承認済み')->get();
            return view('apply_list', compact('clocks'));

        }elseif($request->has('管理者承認待ち')){
            $clocks = ApplyClock::where('correction_check', '承認待ち')->get();
            return view('apply_list', compact('clocks'));

        }elseif($request->has('管理者承認済み')){
            $clocks = ApplyClock::where('correction_check', '承認済み')->get();
            return view('apply_list', compact('clocks'));

        }else{
            $id = $request->id;
            $clocks = ApplyClock::find($id);
            $breaks = ApplyBreak::where('apply_clock_id', $id)->get();
            return view('apply_details', compact('clocks', 'breaks'));
        }
    }
    public function attendanceDetail($id){
        $clocks = Clock::find($id);
        $breaks = BreakTime::where('clock_id', $id)->get();
        return view('attendance_details', compact('clocks', 'breaks'));
    }
    public function attendanceDetailCreate(DetailRequest $request, $id){
        $user_id = $request->user_id;
        $applyClocks = [
            'user_id' => $user_id,
            'clock_id' => $request->clock_id,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'remark' => $request->remark,
            'correction_check' => '承認待ち'
        ];
        $applyClocks = ApplyClock::create($applyClocks);
        $applyBreaks = [
            'apply_clock_id' => $applyClocks->id,
            'break_time_id' => $request->break_time_id,
            'break_in' => $request->break_in,
            'break_out' => $request->break_out,
            'correction_check' => '承認待ち'
        ];
        $applyBreaks = ApplyBreak::create($applyBreaks);

        if($request->has('admin')){
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
           if(@isset($break_time)){
              $clocks = [
               'clock_time' => $diffInSeconds,
               'break_time' => $break_time,
           ];
           }else{
               $clocks = [ 'clock_time' => $diffInSeconds];
           }
           unset($clocks['_token']);
           Clock::find($request->clock_id)->update($clocks);
           $applyClock = [ 'correction_check' => '承認済み' ];
           unset($applyClocks['_token']);
           ApplyClock::find($applyClocks->id)->update($applyClock);
           if(@isset($applyBreaks->id)){
              $applyBreak = [ 'correction_check' => '承認済み' ];
              unset($applyBreak['_token']);
              ApplyBreak::find($applyBreaks->id)->update($applyBreak);
           }

           $clocks = ApplyClock::where('user_id', '!=', '1')->get();
           return view('admin.apply_list', compact('clocks'));
        }
        $clocks = ApplyClock::where('user_id', $user_id)->get();
        return view('apply_list', compact('clocks'));

    }

    public function applyDetailGet($id)
    {
        $clocks = ApplyClock::find($id);
        $breaks = ApplyBreak::where('apply_clock_id', $id)->get();
        return view('apply_details', compact('clocks', 'breaks'));
    }
}
