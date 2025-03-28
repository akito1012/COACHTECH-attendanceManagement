@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/apply_list.css') }}">
@endsection

@section('content')

<div class="attendance__detail">
    <form action="" class="attendance-detail__form">
        <div class="attendance-detail__title">
            <h3 class="attendance-detail__header">｜申請一覧</h3>
        </div>
        <div class="correction__button">
            <button class="pending-approval__button">承認待ち</button>
            <button class="approved__button">承認済み</button>
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
            <tr class="attendance-detail__table-row">
                <td class="attendance-detail__table-date">
                    <input type="text"value="状態" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="名前" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="対象日時" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="申請理由" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <input type="text"value="申請日時" class="input__date">
                </td>
                <td class="attendance-detail__table-date">
                    <button class="attendance-detail__button">詳細</button>
                </td>
            </tr>
        </table>
    </form>
</div>

@endsection