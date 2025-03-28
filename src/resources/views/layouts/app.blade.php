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
        <form action="/" method="get" class="header__form">
            <div class="header__logo">
                <img src="{{ asset('img/coachtech_logo.svg') }}" alt="COACHTECH" class="coachtech__logo">
            </div>
            <div class="header__button">
                <button class="clock__button">勤怠</button>
                <button class="attendance-list__button">勤怠一覧</button>
                <button class="staff-list__button">スタッフ一覧</button>
                <button class="correct__button">申請</button>
                <button class="correct-list__button">申請一覧</button>
                <button class="logout__button">ログアウト</button>
            </div>
        </form>
    </header>
</body>

<main>
    @yield('content')
</main>

</html>