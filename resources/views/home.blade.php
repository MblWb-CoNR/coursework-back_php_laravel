<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>All Fine</title>
    <link rel="stylesheet" href="{{ asset('css/who.css') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon.ico') }}">
</head>
<body>
<div style="display: none;">
    <p>Проверка путей:</p>
    <p>Logo: {{ asset('img/logo.svg') }}</p>
    <p>Favicon: {{ asset('img/favicon.ico') }}</p>
</div>
<header>
    <div class="head">
        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('img/logo.svg') }}" alt="logo"></a>
        <nav>
            <li><a href="{{ route('portfolio.index') }}">Работы</a></li>
            <li><a href="{{ route('masters') }}">Мастера</a></li>
            <li><a href="{{ route('contacts') }}">Контакты</a></li>
            <li><a href="{{ route('sign_up') }}">Запись</a></li>
            @auth
                <li><a href="{{ route('profile') }}">Профиль</a></li>
                <li><form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Выйти</button>
                </form></li>
            @else
                <li><a href="{{ route('auth.form') }}">Войти</a></li>
            @endauth
        </nav>
    </div>
</header>
<main>
    <div class="text">
        <p class="max">TATTOO STUDIO</p>
        <p class="mini">ALL <span class="rose">FINE</span></p>
        <p class="mini_mini">[преврати свою кожу
                         в произведение искусства]</p>
        @auth
            <a href="{{ route('sign_up') }}"><input type="button" value="Записаться"></a>
        @else
            <a href="{{ route('auth.form') }}"><input type="button" value="Записаться"></a>
        @endauth
    </div>
    <nav>
        <a href="/"><img src="{{ asset('img/tgRose.svg') }}" alt="tg"></a>
        <a href="/"><img src="{{ asset('img/vkRose.svg') }}" alt="vk"></a>
        <a href="/"><img src="{{ asset('img/instRose.svg') }}" alt="inst"></a>
        <a href="/"><img src="{{ asset('img/pinRose.svg') }}" alt="pin"></a>
    </nav>
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
                <a href="/"><img src="{{ asset('img/telegram.svg') }}" alt="tg"></a>
                <a href="/"><img src="{{ asset('img/vk.svg') }}" alt="vk"></a>
                <a href="/"><img src="{{ asset('img/instagram.svg') }}" alt="inst"></a>
                <a href="/"><img src="{{ asset('img/pinterest-64.svg') }}" alt="pin"></a>
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
