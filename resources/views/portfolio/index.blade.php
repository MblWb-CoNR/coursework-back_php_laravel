<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Работы - All Fine</title>
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
