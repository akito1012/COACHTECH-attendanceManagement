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
            <form action="/attendanse/list" method="get" class="attendance-list">
                @csrf
                <a href="{{ route('admin.attendance_list') }}" class="attendance-list__button">勤怠一覧</a>
            </form>
            <form action="/admin/staff/list">
                @csrf
                <button class="staff-list__button" type="submit">スタッフ一覧</button>
            </form>
            <form action="/stamp_correction_request/list" method="get">
                <button class="correct-list__button" name="admin">申請一覧</button>
            </form>
            <form action="/logout" method="post" class="logout__form">
                @csrf
                <button class="logout__button" type="submit" name="admin">ログアウト</button>
            </form>
            @else
                <a href="/login" class="login__link">
                    <button class="login__button" type="submit" name="admin">ログイン</button>
                </a>
            @endif
        </div>
    </header>
</body>

<main>
    @yield('content')
</main>

</html>