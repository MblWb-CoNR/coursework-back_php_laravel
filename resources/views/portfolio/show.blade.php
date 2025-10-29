<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $work->title }} - All Fine</title>
    <link rel="stylesheet" href="/css/works_style.css">
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
                <form method="POST" action="{{ route('logout') }}">
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
