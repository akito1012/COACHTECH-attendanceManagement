@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/apply_list.css') }}">
@endsection

@section('content')

<div class="apply__list">
    <form action="/attendance/{id}" method="post" class="apply-list__form">
        @csrf
        <div class="apply-list__title">
            <h3 class="apply-list__header">｜勤怠詳細</h3>
        </div>

        <table class="apply-list__table">
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">名前</th>
                <td class="apply-list__table-date">
                    <input type="text" value="{{ Auth::user()->name }}" class="input__name">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">日付</th>
                <td class="apply-list__table-date">
                    <p class="input__year">{{ $clocks->clock_in->format('Y年') }}</p>
                    <p class="input__mouth">{{ $clocks->clock_in->format('m月d日') }}</p>
                </td>
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">出勤・退勤</th>
                <td class="apply-list__table-date">
                    <input type="datetime" name="clock_in" value="{{ $clocks->clock_in->format('H:i') }}" class="input__clock-in">
                    <p class="form__line">~</p>
                    <input type="datetime" name="clock_out"value="{{ $clocks->clock_out->format('H:i') }}" class="input__clock-out">
                    <input type="hidden" name="clock_id" value="{{ $clocks->id }}">
                </td>
            </tr>
            <tr class="apply-list__table-row">
                @foreach($breaks as $break)
                <th class="apply-list__table-header">休憩</th>
                <td class="apply-list__table-date">
                    <input type="hidden" name="break_time_id" value="{{ $break->id }}">
                    <input type="datetime" name="break_in"value="{{ $break->break_in->format('H:i') }}" class="input__break-in">
                    <p class="form__line">~</p>
                    <input type="datetime" name="break_out" value="{{ $break->break_out->format('H:i') }}" class="input__break-out">
                </td>
                @endforeach
            </tr>
            <tr class="apply-list__table-row">
                <th class="apply-list__table-header">備考</th>
                <td class="apply-list__table-date">
                    <textarea name="remark" value="{{ '備考' }}" class="textarea__remarks">備考欄</textarea>
                </td>
            </tr>
        </table>
        <div class="apply-detail__check">
            @if($clocks->correction_check == '承認待ち')
            <p class="apply-detail__correction" type="submit">＊承認待ちのため修正はできません</p>
            @endif
        </div>
    </form>
</div>

@endsection