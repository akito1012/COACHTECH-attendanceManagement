@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')

<div class="login">
    <form action="/login" method="post" class="login__form">
        @csrf
        <div class="login__title">
            <h2 class="login__header">ログイン</h2>
        </div>
        <div class="login__inner">
            <div class="login__input">
                <label for="" class="input__label">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input__item" />
            </div>
            <div class="error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="login__input">
                <label for="" class="input__label">パスワード</label>
                <input type="password" input type="password" name="password" class="input__item" />
            </div>
            <div class="error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="login__button">
                <button class="login__button-submit" type="submit" name="user">ログインする</button>
                <input type="hidden" name="login_check" value="user">
            </div>
            <div class="register__link">
                <a href="/register" class="register__link-url">会員登録はこちら</a>
            </div>
        </div>
    </form>
</div>

@endsection