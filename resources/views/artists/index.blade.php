<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0">
    <title>Мастера - All Fine</title>
    <link rel="stylesheet" href="/css/they.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.ico">
</head>
<body>
<header>
    <div class="head">
        <a class="logo" href="{{ route('home') }}"><img src="/img/logo.svg" alt="logo"></a>
        <nav>
            <a href="{{ route('portfolio.index') }}">Работы</a>
            <a href="{{ route('artists.index') }}">Мастера</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('sign_up') }}">Запись</a>
            @auth
                <a href="{{ route('profile') }}">Профиль</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout_btn">Выйти</button>
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
