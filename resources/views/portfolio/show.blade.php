<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $work->title }} - All Fine</title>
    <link rel="stylesheet" href="/css/works_style.css">
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

        .work-detail {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .back-link {
            display: inline-block;
            margin: 30px 0 20px 7%;
            color: #464646;
            text-decoration: none;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #333;
            text-decoration: underline;
        }

        .work-content {
            display: flex;
            gap: 50px;
            align-items: flex-start;
            margin: 0 7%;
        }

        .work-image {
            flex: 1;
            max-width: 600px;
        }

        .work-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .work-info {
            flex: 1;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .work-title {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 24pt;
            color: #464646;
            margin-bottom: 15px;
        }

        .work-artist {
            font-family: "MuseoModerno", sans-serif;
            font-size: 18pt;
            color: #666;
            margin-bottom: 30px;
        }

        .work-description {
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            line-height: 1.6;
            color: #555;
            margin-bottom: 30px;
        }

        .admin-actions {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background: #c82333;
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
            <a href="{{ route('masters') }}">Мастера</a>
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
    <a href="{{ route('portfolio.index') }}" class="back-link">← Назад к галерее</a>

    <div class="work-content">
        <div class="work-image">
            <img src="{{ Storage::disk('public')->url($work->image_path) }}"
                 alt="{{ $work->title }}">
        </div>

        <div class="work-info">
            <h1 class="work-title">{{ $work->title }}</h1>
            <div class="work-artist">
                Мастер: <strong>{{ $work->artist->user->username }}</strong>
            </div>

            @if($work->description)
                <div class="work-description">
                    {{ $work->description }}
                </div>
            @else
                <div class="work-description" style="color: #999; font-style: italic;">
                    Описание отсутствует
                </div>
            @endif

            <!-- Админские действия -->
            @auth
                @if(Auth::user()->isAdmin())
                    <div class="admin-actions">
                        <form method="POST" action="{{ route('portfolio.destroy', $work->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger"
                                    onclick="return confirm('Удалить эту работу?')">
                                Удалить работу
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
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
