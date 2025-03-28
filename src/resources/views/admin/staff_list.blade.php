@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/staff_list.css') }}">
@endsection

@section('content')

<div class="attendance__detail">
    <form action="" class="attendance-detail__form">
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
                <td class="attendance-detail__table-date">
                    <input type="text"value="名前" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="メールアドレス" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="月次勤怠" class="input__date">
                </td>
            </tr>
        </table>
    </form>
</div>

@endsection