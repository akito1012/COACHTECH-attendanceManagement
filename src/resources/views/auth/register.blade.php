@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')

<div class="user__register">
    <form action="/register" method="get" class="user-register__form">
        <div class="register__title">
            <h2 class="register__header">会員登録</h2>
        </div>
        <div class="register__inner">
            <div class="register__input">
                <label for="" class="input__label">名前</label>
                <input type="text" class="input__item" value="名前">
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">メールアドレス</label>
                <input type="text" class="input__item" value="メールアドレス">
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">パスワード</label>
                <input type="text" class="input__item" value="パスワード">
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">パスワード確認</label>
                <input type="text" class="input__item" value="確認用パスワード">
            </div>
            <div class="error">ERROR</div>
            <div class="register__button">
                <button class="register__button-submit">登録する</button>
            </div>
            <div class="login__link">
                <a href="" class="login__link-url">ログインはこちら</a>
            </div>
        </div>
    </form>
</div>

@endsection