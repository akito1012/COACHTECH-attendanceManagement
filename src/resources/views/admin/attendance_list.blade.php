@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/attendance_list.css') }}">
@endsection

@section('content')

<div class="attendance__recode">
    <form action="" class="attendance-recode__form">
        <div class="attendance-recode__title">
            <h3 class="attendance-recode__header">|年月日の勤怠</h3>
        </div>
        <div class="attendance-recode__month">
            <button class="last-month">←前日</button>
            <input type="text" value="本日" class="this-month">
            <button class="next-month">翌日→</button>
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
            <tr class="attendance-recode__row">
                <td class="attendance-recode__date">
                    <input type="text" value="名前" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="出勤" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="退勤" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="休憩"class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <input type="text" value="合計" class="input__attendance-item">
                </td>
                <td class="attendance-recode__date">
                    <button class="attendance-detail__button">詳細</button>
                </td>
            </tr>
        </table>
    </form>
</div>


@endsection