@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/staff_attendance_list.css') }}">
@endsection

@section('content')

<div class="attendance__recode">
    <form action="{{ route('admin.attendance_staff', ['id' => $user->id]) }}" method="post" class="attendance-recode__form">
        @csrf
        <div class="attendance-recode__title">
            <input type="text" name="user_id" value="{{ $user->id }}">
            <h3 class="attendance-recode__header">|{{ $user->name }}さんの勤怠</h3>
        </div>
        <div class="attendance-recode__month">
            <button class="last-month" type="submit" name="subMonth">←前月</button>
            <input type="text" value="{{ $now->format('Y/m') }}" class="this-month">
            <input type="hidden" name="month" value="{{ $now }}">
            <button class="next-month" type="submit" name="addMonth">翌月→</button>
        </div>
        <table class="attendance-recode__table">
            <tr class="attendance-recode__row">
                <th class="attendance-recode__table-header">日付</th>
                <th class="attendance-recode__table-header">出勤</th>
                <th class="attendance-recode__table-header">退勤</th>
                <th class="attendance-recode__table-header">休憩</th>
                <th class="attendance-recode__table-header">合計</th>
                <th class="attendance-recode__table-header">詳細</th>
            </tr>
            @foreach($clocks as $clock)
            <tr class="attendance-recode__row">
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->clock_in->format('m月d日(w)') }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->clock_in->format('h:i') }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ $clock->clock_out->format('h:i') }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ floor($clock->break_time / 3600) }} : {{ sprintf('%02d', (floor(($clock->break_time % 3600) / 60))) }}"class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="{{ floor($clock->clock_time /3600) }} : {{ sprintf('%02d', (floor(($clock->clock_time % 3600) / 60))) }}" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="hidden" name="clock_id" value="{{ $clock->id }}">
                    <button type="submit" name="detail" class="attendance-detail__button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </form>
</div>


@endsection