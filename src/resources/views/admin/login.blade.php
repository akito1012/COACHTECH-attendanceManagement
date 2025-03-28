@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
@endsection

@section('content')

<div class="login">
    <form action="/login" method="get" class="login__form">
        <div class="login__title">
            <h2 class="login__header">管理者ログイン</h2>
        </div>
        <div class="login__inner">
            <div class="login__input">
                <label for="" class="input__label">メールアドレス</label>
                <input type="text" value="メールアドレス" class="input__item">
            </div>
            <div class="error">ERROR</div>
            <div class="login__input">
                <label for="" class="input__label">パスワード</label>
                <input type="text" value="パスワード" class="input__item">
            </div>
            <div class="error">ERROR</div>
            <div class="login__button">
                <button class="login__button-submit">管理者ログインする</button>
            </div>
        </div>
    </form>
</div>


@endsection