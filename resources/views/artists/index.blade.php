<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">
    <title>Мастера - All Fine</title>
    <link rel="stylesheet" href="/css/they.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.ico">
    <style>
        @font-face {
            font-family: "ISOCPEUR";
            src: url(/fonts/ISOCPEUR.ttf);
        }

        @font-face {
            font-family: "MuseoModerno";
            src: url(/fonts/MuseoModerno-Regular.ttf);
        }

        @font-face {
            font-family: "MuseoModerno.Bold";
            src: url(/fonts/MuseoModerno-Bold.ttf);
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #E2E2E2;
        }

        .head {
            max-width: 1620px;
            display: flex;
            justify-content: space-between;
            margin-left: 7%;
        }

        .logo {
            max-width: 232px;
            max-height: 117px;
            padding-top: 0.9%;
        }

        .head > nav {
            display: flex;
            gap: 60px;
            padding-top: 5%;
            max-width: 500px;
        }

        .head > nav > a {
            text-decoration: none;
            color: #464646;
            font-size: 18pt;
            font-family: "ISOCPEUR", sans-serif;
        }

        main {
            margin-bottom: 6%;
        }

        main > p {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 27pt;
            margin-top: 2.6%;
            margin-bottom: 5.8%;
            margin-left: 46%;
        }

        .masters {
            display: flex;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            gap: 50px;
        }

        .mas_left, .mas_right {
            display: flex;
            flex-direction: column;
            gap: 50px;
            flex: 1;
        }

        .leoka, .supegoran, .frolikus, .black_geo {
            display: flex;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .mas_left .leoka, .mas_left .supegoran {
            flex-direction: row;
        }

        .mas_right .frolikus, .mas_right .black_geo {
            flex-direction: row-reverse;
        }

        .leoka:hover, .supegoran:hover, .frolikus:hover, .black_geo:hover {
            transform: translateY(-5px);
        }

        .about img {
            width: 250px;
            height: 250px;
            border-radius: 10px;
            object-fit: cover;
        }

        .name {
            flex: 1;
            padding: 0 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .naming {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 22pt;
            color: #464646;
            margin-bottom: 10px;
        }

        .style {
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            color: #666;
            margin-bottom: 20px;
        }

        .inst {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .inst img {
            width: 24px;
            height: 24px;
        }

        .nickname {
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            color: #464646;
        }

        .butt {
            display: inline-block;
            padding: 12px 30px;
            background: #464646;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 14pt;
            text-align: center;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .butt:hover {
            background: #333;
        }

        .message {
            text-align: center;
            margin: 20px auto;
            padding: 15px;
            border-radius: 10px;
            max-width: 600px;
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
        }

        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        footer {
            background-color: rgba(219, 159, 165, .14);
            padding-top: 2.2%;
            padding-bottom: 2.2%;
        }

        .cont {
            display: flex;
            justify-content: space-between;
            max-width: 1270px;
            margin-left: 133px;
        }

        .bigger {
            font-size: 18pt;
            margin-bottom: 19%;
        }

        .up {
            margin-top: 13%;
        }

        .time {
            display: flex;
            flex-direction: column;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 15pt;
        }

        .write {
            display: flex;
            flex-direction: column;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 15pt;
        }

        .write > nav {
            display: flex;
            gap: 20px;
        }

        .write > nav > a > img{
            height: 40px;
            width: 40px;
        }

        .call {
            display: flex;
            flex-direction: column;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 15pt;
        }
    </style>
</head>
<body>
<header>
    <div class="head">
        <a class="logo" href="{{ route('home') }}"><img src="/img/logo.svg" alt="logo"></a>
        <nav>
            <a href="{{ route('portfolio.index') }}">Работы</a>
            <a href="{{ route('artists.index') }}" style="text-decoration: underline;">Мастера</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('sign_up') }}">Запись</a>
            @auth
                <a href="{{ route('profile') }}">Профиль</a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('portfolio.create') }}">Добавить работу</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font-family: 'ISOCPEUR', sans-serif; font-size: 18pt;">Выйти</button>
                </form>
            @else
                <a href="{{ route('auth.form') }}">Войти</a>
            @endauth
        </nav>
    </div>
</header>
<main>
    <p>[мастера]</p>

    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    <div class="masters">
        <div class="mas_left">
            @foreach($artists->take(2) as $artist)
                <div class="leoka">
                    <div class="about">
                        @if($artist->user->avatar)
                            <img src="{{ Storage::disk('public')->url($artist->user->avatar->file_path) }}" alt="{{ $artist->user->username }}">
                        @else
                            <img src="/img/placeholder.jpg" alt="{{ $artist->user->username }}">
                        @endif
                    </div>
                    <div class="name">
                        <p class="naming">{{ $artist->user->username }}</p>
                        <p class="style">
                            @foreach($artist->styles as $style)
                                {{ $style->style_name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <div class="inst">
                            <img src="/img/instagram.svg" alt="inst">
                            <p class="nickname">{{ $artist->user->username }}</p>
                        </div>
                        <a class="butt" href="{{ route('artists.show', $artist->id) }}">О мастере</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mas_right">
            @foreach($artists->skip(2) as $artist)
                <div class="frolikus">
                    <div class="name">
                        <p class="naming">{{ $artist->user->username }}</p>
                        <p class="style">
                            @foreach($artist->styles as $style)
                                {{ $style->style_name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <div class="inst">
                            <img src="/img/instagram.svg" alt="inst">
                            <p class="nickname">{{ $artist->user->username }}</p>
                        </div>
                        <a class="butt" href="{{ route('artists.show', $artist->id) }}">О мастере</a>
                    </div>
                    <div class="about">
                        @if($artist->user->avatar)
                            <img src="{{ Storage::disk('public')->url($artist->user->avatar->file_path) }}" alt="{{ $artist->user->username }}">
                        @else
                            <img src="/img/placeholder.jpg" alt="{{ $artist->user->username }}">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
<footer>
    <div class="cont">
        <div class="time">
            <p class="bigger">Прийти</p>
            <p>Часы работы</p>
            <p>с 10:00 до 22:00, ежедневно</p>
            <p class="up">Адрес:</p>
            <p>Томск, Ленина 18/3</p>
        </div>
        <div class="write">
            <p class="bigger">Написать</p>
            <nav>
                <a href="#"><img src="/img/telegram.svg" alt="tg"></a>
                <a href="#"><img src="/img/vk.svg" alt="vk"></a>
                <a href="#"><img src="/img/instagram.svg" alt="inst"></a>
                <a href="#"><img src="/img/pinterest-64.svg" alt="pin"></a>
            </nav>
            <p class="up">all.fine@tattoo.ru</p>
        </div>
        <div class="call">
            <p class="bigger">Позвонить</p>
            <p>Телефон:</p>
            <p>+7-999-888-35-35</p>
        </div>
    </div>
</footer>
</body>
</html>
