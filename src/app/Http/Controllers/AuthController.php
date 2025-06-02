<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Clock;
use App\Models\BreakTime;
use App\Models\ApplyClock;
use App\Models\ApplyBreak;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        Auth::login($user);
        return view('clock_register');
    }
    public function login(LoginRequest $request){
        $credentials=$request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $login_check = $request->login_check;
            if($login_check == 'admin'){
                $now = Carbon::now();
                $today = Carbon::today();
                $clocks = Clock::whereDate('created_at', $today)->get();
                return view('admin.attendance_list', compact('now', 'today', 'clocks'));
            }
            if($login_check == 'user'){
                $day = Carbon::now()->formatLocalized('%Y年%m月%d日(%a)');
                $time = Carbon::now()->format("H:i");
                $clock_check = '';
                $break_check = '';
                return view('clock_register', compact('day', 'time', 'clock_check', 'break_check'));
            }  
        }else{
            if($login_check == 'admin'){
                return view('admin.login')->with('message', 'ログイン情報が登録されていません');
            }
            if($login_check == 'user'){
                return view('auth.login')->with('message', 'ログイン情報が登録されていません');
            }
        }
        return back();

        }
    public function adminLogin(){
        return view('admin.login');
    }
    public function logout(Request $request){
        if($request->has('admin')){
            return view('admin.login');
        }
        if($request->has('user')){
            return view('auth.login');
        }
        return view('auth.login');
    }
}
