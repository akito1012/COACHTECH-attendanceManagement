@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/attendance_list.css') }}">
@endsection

@section('content')

<div class="attendance__recode">
    <form action="/admin/attendance/list" method="post" class="attendance-recode__form">
        @csrf
        <div class="attendance-recode__title">
            <h3 class="attendance-recode__header">|年月日の勤怠</h3>
        </div>
        <div class="attendance-recode__month">
            <button class="last-month" type="submit" name="subDay">←前日</button>
            <input type="text" value="{{ $now->format('Y/m/d') }}" class="this-month">
            <input type="hidden" name="today" value="{{ $today }}">
            <button class="next-month" type="submit" name="addDay">翌日→</button>
        </div>
        <table class="attendance-recode__table">
            <tr class="attendance-recode__row">
                <th class="attendance-recode__table-header">名前</th>
                <th class="attendance-recode__table-header">出勤</th>
                <th class="attendance-recode__table-header">退勤</th>
                <th class="attendance-recode__table-header">休憩</th>
                <th class="attendance-recode__table-header">合計</th>
                <th class="attendance-recode__table-header">詳細</th>
            </tr>
            @foreach($clocks as $clock)
            <tr class="attendance-recode__row">
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->user->name }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->clock_in->format('H:i') }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->clock_out->format('H:i') }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ floor($clock->break_time / 3600) }} : {{ sprintf('%02d', (floor(($clock->break_time % 3600) / 60))) }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ floor($clock->clock_time / 3600) }} : {{ sprintf('%02d', (floor(($clock->clock_time % 3600) / 60))) }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                <button type="submit" name="id" value="{{ $clock->id }}"class="attendance-detail__button">詳細</button>
            </tr>
            @endforeach
        </table>
    </form>
</div>


@endsection