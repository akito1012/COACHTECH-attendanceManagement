@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/correction.css') }}">
@endsection

@section('content')

<div class="apply__list">
    <form action="" class="apply-list__form">
        <div class="apply-list__title">
            <h3 class="apply-list__header">｜勤怠詳細</h3>
        </div>
        <table class="apply-list__table">
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">名前</th>
                <td class="apply-list__table-date">
                    <input type="text" value="名前" class="input__name">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">日付</th>
                <td class="apply-list__table-date">
                    <input type="text" value="年" class="input__year">
                    <p class="form__line">~</p>
                    <input type="text" value="月日" class="input__mouth">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">出勤・退勤</th>
                <td class="apply-list__table-date">
                    <input type="text" value="出勤時間" class="input__clock-in">
                    <p class="form__line">~</p>
                    <input type="text" value="退勤時間" class="input__clock-out">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">休憩</th>
                <td class="apply-list__table-date">
                    <input type="text" value="休憩入り" class="input__break-in">
                    <p class="form__line">~</p>
                    <input type="text" value="休憩戻り" class="input__break-out">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">備考</th>
                <td class="apply-list__table-date">
                    <textarea name="" id="" class="textarea__remarks">備考欄</textarea>
                </td>
            </tr>
        </table>
    </form>
</div>

@endsection