@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/clock_register.css') }}">
@endsection

@section('content')

<div class="clock">
    <form action="/attendance" method="post" class="clock__form">
        @csrf
        <div class="clock__inner">
            <div class="clock__situation">
                @if($clock_check == 'clock_in')
                    <button class="situation__input">出勤中</button>
                @elseif($clock_check == 'clock_out')
                    <button class="situation__input">退勤済</button>
                @elseif($break_check == 'break_in')
                    <button class="situation__input">休憩中</button>
                @else
                    <button class="situation__input">勤務外</button>
                @endif
            </div>
            <div class="clock__day">
                <input type="text"value="{{ $day }} "class="day__input">
            </div>
            <div class="clock__time">
                <input type="text" value="{{ $time }}"class="time__input">
            </div>
            <div class="clock-register__button">
                @if($clock_check == '')
                <button class="clock__button-black" type="submit" name="clock_check" value="clock_in">出勤</button>
                @elseif($clock_check == 'clock_in')
                <button class="clock__button-black" type="submit" name="clock_check" value="clock_out">退勤</button>
                <button class="clock__button-white" type="submit" name="break_check" value="break_in">休憩入</button>
                @elseif($break_check == 'break_in')
                <button class="clock__button-white" type="submit" name="break_check" value="break_out">休憩戻</button>
                @else($clock_check == 'clock_out')
                <p class="clock__comment">お疲れさまでした</p>
                @endif
                @if(@isset($clock_id))
                <input type="text" name="clock_id" value="{{ $clock_id }}">
                @endif
                @if(@isset($break_times_id))
                <input type="text" name="break_times_id" value="{{ $break_times_id }}">
                @endif
            </div>
        </div>
    </form>
</div>

@endsection