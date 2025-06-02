@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/staff_list.css') }}">
@endsection

@section('content')

<div class="attendance__detail">
    <form action="/admin/staff/list" method="get" class="attendance-detail__form">
        <div class="attendance-detail__title">
            <h3 class="attendance-detail__header">｜スタッフ一覧</h3>
        </div>
        <table class="attendance-detail__table">
            <tr class="attendance-detail__table-row">
                <th class="attendance-detail__table-header">名前</th>
                <th class="attendance-detail__table-header">メールアドレス</th>
                <th class="attendance-detail__table-header">月次勤怠</th>
            </tr>
            <tr class="attendance-detail__table-row">
                @foreach($users as $user)
                <td class="attendance-detail__table-date">
                    <input type="text"value="{{ $user->name }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="{{ $user->email }}" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <a href="{{ route('admin.attendance_staff', ['id'=>$user->id]) }}" class="input_date">月次勤怠</a>
                </td>
                @endforeach
            </tr>
        </table>
    </form>
</div>

@endsection