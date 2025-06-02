@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user/attendance_details.css') }}">
@endsection

@section('content')

<div class="attendance__detail">
    <form action="/stamp_correction_request/list" method="post" class="attendance-detail__form">
        @csrf
        <div class="attendance-detail__title">
            <h3 class="attendance-detail__header">｜申請一覧</h3>
        </div>
        <div class="correction__button">
            <button class="pending-approval__button" type="submit" name="承認待ち">承認待ち</button>
            <button class="approved__button" type="submit" name="承認済み">承認済み</button>
        </div>
        <table class="attendance-detail__table">
            <tr class="attendance-detail__table-row">
                <th class="attendance-detail__table-header">状態</th>
                <th class="attendance-detail__table-header">名前</th>
                <th class="attendance-detail__table-header">対象日時</th>
                <th class="attendance-detail__table-header">申請理由</th>
                <th class="attendance-detail__table-header">申請日時</th>
                <th class="attendance-detail__table-header">詳細</th>
            </tr>
            @foreach($clocks as $clock)
            <tr class="attendance-detail__table-row">
                <td class="attendance-detail__table-date">
                    <input type="text" value="{{ $clock->correction_check }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text" value="{{ $clock->user->name }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text" value="{{ $clock->clock_in->format('Y/m/d') }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text" value="{{ $clock->remark }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text" value="{{ $clock->created_at->format('Y/m/d') }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <button type="submit" name="id" value="{{ $clock->id }}"class="attendance-detail__button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </form>
</div>

@endsection