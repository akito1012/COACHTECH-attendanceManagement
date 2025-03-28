@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')

<div class="login">
    <form action="/login" method="get" class="login__form">
        <div class="login__title">
            <h2 class="login__header">ログイン</h2>
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
                <button class="login__button-submit">ログインする</button>
            </div>
            <div class="register__link">
                <a href="" class="register__link-url">会員登録はこちら</a>
            </div>
        </div>
    </form>
</div>

@endsection