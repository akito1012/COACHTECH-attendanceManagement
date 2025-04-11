@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')

<div class="user__register">
    <form action="/register" method="post" class="user-register__form">
        @csrf
        <div class="register__title">
            <h2 class="register__header">会員登録</h2>
        </div>
        <div class="register__inner">
            <div class="register__input">
                <label for="" class="input__label">名前</label>
                <input type="text" class="input__item" name="name" value="{{ old('name') }}" />
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">メールアドレス</label>
                <input type="email" class="input__item" name="email" value="{{ old('email') }}" />
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">パスワード</label>
                <input type="password" class="input__item" input type="password" name="password" />
            </div>
            <div class="error">ERROR</div>
            <div class="register__input">
                <label for="" class="input__label">パスワード確認</label>
                <input type="password" class="input__item" name="password_confirmation" />
            </div>
            <div class="error">ERROR</div>
            <div class="register__button">
                <button class="register__button-submit">登録する</button>
            </div>
            <div class="login__link">
                <a href="/login" class="login__link-url">ログインはこちら</a>
            </div>
        </div>
    </form>
</div>

@endsection