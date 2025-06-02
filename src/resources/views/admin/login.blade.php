@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
@endsection

@section('content')

<div class="login">
    <form action="/login" method="post" class="login__form">
        @csrf
        <div class="login__title">
            <h2 class="login__header">管理者ログイン</h2>
        </div>
        <div class="login__inner">
            <div class="login__input">
                <label for="" class="input__label">メールアドレス</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input__item">
            </div>
            <div class="error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="login__input">
                <label for="" class="input__label">パスワード</label>
                <input type="text" name="password" value="{{ old('password') }}" class="input__item">
            </div>
            <div class="error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="login__button">
                <button class="login__button-submit" type="submit" name="admin">管理者ログインする</button>
                <input type="hidden" name="login_check" value="admin">
            </div>
        </div>
    </form>
</div>


@endsection