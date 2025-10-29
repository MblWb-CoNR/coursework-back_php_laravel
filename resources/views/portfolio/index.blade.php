<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Работы - All Fine</title>
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

        main > p {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 27pt;
            margin-top: 2.6%;
            margin-bottom: 5.8%;
            margin-left: 46%;
        }

        .pictures {
            display: flex;
            flex-direction: column;
            margin-left: 11.1%;
            margin-top: 5.8%;
        }

        .f_row {
            display: flex;
            gap: 4.7%;
            margin-bottom: 4.7%;
        }

        .f_row > .work-card {
            position: relative;
            height: 450px;
            width: 450px;
            border-radius: 10px;
            overflow: hidden;
        }

        .f_row > .work-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .f_row > .work-card:hover img {
            transform: scale(1.05);
        }

        .work-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .work-card:hover .work-overlay {
            transform: translateY(0);
        }

        .work-title {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            margin-bottom: 5px;
        }

        .work-artist {
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            color: #ccc;
        }

        .s_row > .work-card {
            position: relative;
            height: 450px;
            width: 450px;
            border-radius: 10px;
            overflow: hidden;
        }

        .s_row > .work-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .s_row > .work-card:hover img {
            transform: scale(1.05);
        }

        .s_row {
            display: flex;
            gap: 4.7%;
        }

        .filters {
            text-align: center;
            margin-bottom: 30px;
        }

        .filter-btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background: #f0f0f0;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            color: #464646;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            transition: all 0.3s ease;
        }

        .filter-btn.active, .filter-btn:hover {
            background: #464646;
            color: white;
        }

        .add-work-btn {
            display: inline-block;
            padding: 12px 24px;
            background: #464646;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            margin-bottom: 30px;
            transition: background 0.3s ease;
        }

        .add-work-btn:hover {
            background: #333;
        }

        .admin-actions {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-family: "MuseoModerno", sans-serif;
            font-size: 12pt;
            transition: background 0.3s ease;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .pagination {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 10px 18px;
            margin: 0 5px;
            background: #f0f0f0;
            border-radius: 25px;
            text-decoration: none;
            color: #464646;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #464646;
            color: white;
        }

        .current-artist {
            text-align: center;
            margin-bottom: 30px;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 20pt;
            color: #464646;
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
            <a href="{{ route('portfolio.index') }}" style="text-decoration: underline;">Работы</a>
            <a href="{{ route('masters') }}">Мастера</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('sign_up') }}">Запись</a>
            @auth
                <a href="{{ route('profile') }}">Профиль</a>
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
    <p>[работы]</p>

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

    <!-- Кнопка добавления для админов -->
    @auth
        @if(Auth::user()->isAdmin())
            <div style="text-align: center;">
                <a href="{{ route('portfolio.create') }}" class="add-work-btn">+ Добавить работу</a>
            </div>
        @endif
    @endauth

    <!-- Фильтры по мастерам -->
    <div class="filters">
        <a href="{{ route('portfolio.index') }}" class="filter-btn {{ !request()->is('portfolio/artist/*') ? 'active' : '' }}">
            Все работы
        </a>
        @foreach($artists as $artistItem)
            <a href="{{ route('portfolio.artist', $artistItem->id) }}"
               class="filter-btn {{ isset($artist) && $artist->id == $artistItem->id ? 'active' : '' }}">
                {{ $artistItem->user->username }}
            </a>
        @endforeach
    </div>

    <!-- Текущий мастер (если фильтр по мастеру) -->
    @if(isset($artist))
        <div class="current-artist">
            Работы мастера: {{ $artist->user->username }}
        </div>
    @endif

    <!-- Сетка работ -->
    @if($works->count() > 0)
        @foreach($works->chunk(3) as $chunk)
            <div class="pictures">
                <div class="f_row">
                    @foreach($chunk as $work)
                        <div class="work-card">
                            <a href="{{ route('portfolio.show', $work->id) }}">
                                <img src="{{ Storage::disk('public')->url($work->image_path) }}"
                                     alt="{{ $work->title }}">
                            </a>
                            <div class="work-overlay">
                                <div class="work-title">{{ $work->title }}</div>
                                <div class="work-artist">{{ $work->artist->user->username }}</div>
                            </div>

                            <!-- Админские действия -->
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <div class="admin-actions">
                                        <form method="POST" action="{{ route('portfolio.destroy', $work->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger"
                                                    onclick="return confirm('Удалить эту работу?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Пагинация -->
        <div class="pagination">
            {{ $works->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 50px;">
            <p style="font-family: 'ISOCPEUR', sans-serif; font-size: 20pt; color: #464646;">
                Пока нет работ в портфолио.
            </p>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('portfolio.create') }}" class="add-work-btn">Добавить первую работу</a>
                @endif
            @endauth
        </div>
    @endif
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
