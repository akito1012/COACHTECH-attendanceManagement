@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/clock_register.css') }}">
@endsection

@section('content')

<div class="clock">
    <form action="/attendance" method="get" class="clock__form">
        <div class="clock__inner">
            <div class="clock__situation">
                <input type="text" value="勤務状況"class="situation__input">
            </div>
            <div class="clock__day">
                <input type="text"value="{{ $day }} "class="day__input">
            </div>
            <div class="clock__time">
                <input type="text" value="{{ $time }}"class="time__input">
            </div>
            <div class="clock-register__button">
                <button class="clock__button-black">出勤</button>
                <button class="clock__button-black">退勤</button>
                <button class="clock__button-white">休憩入</button>
                <button class="clock__button-white">休憩戻</button>
                <p class="clock__comment">お疲れさまでした</p>
            </div>
        </div>
    </form>
</div>

@endsection