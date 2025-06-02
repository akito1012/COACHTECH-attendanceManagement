<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH 勤怠管理アプリ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }} /">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__logo">
            <img src="{{ asset('img/coachtech_logo.svg') }}" alt="COACHTECH" class="coachtech__logo">
        </div>
        <div class="header__button">
            @if(Auth::check())
                <button class="clock__button">勤怠</button>
                <form action="/attendanse/list" method="get" class="attendance-list">
                    @csrf
                    <a href="{{ route('user.attendance_recode') }}" class="attendance-list__button">勤怠一覧</a>
                </form>
                <form action="/stamp_correction_request/list" method="get">
                    <button class="correct__button" type="submit" name="user">申請</button>
                </form>
                <form action="/logout" method="post" class="logout__form">
                    @csrf
                    <button class="logout__button" type="submit" name="user">ログアウト</button>
                </form>
            @else
                <a href="/login" class="login__link">
                    <button class="login__button">ログイン</button>
                </a>
            @endif
        </div>
    </header>
</body>

<main>
    @yield('content')
</main>

</html>