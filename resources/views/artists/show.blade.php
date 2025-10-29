<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artist->user->username }} - All Fine</title>
    <link rel="stylesheet" href="/css/leoka_style.css">
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
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('portfolio.create') }}">Добавить работу</a>
                @endif
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
    <p>[{{ $artist->user->username }}]</p>

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

    <div class="leoka">
        @if($artist->user->avatar)
            <img src="{{ Storage::disk('public')->url($artist->user->avatar->file_path) }}" alt="{{ $artist->user->username }}">
        @else
            <img src="/img/placeholder.jpg" alt="{{ $artist->user->username }}">
        @endif
        <div class="name">
            <p><strong>Стили:</strong>
                @foreach($artist->styles as $style)
                    {{ $style->style_name }}@if(!$loop->last), @endif
                @endforeach
            </p>
            <p><strong>Услуги:</strong><br>
                @foreach($artist->prices as $price)
                    - {{ $price->service->name }}: {{ $price->price }} руб.<br>
                @endforeach
            </p>
        </div>
    </div>

    <div class="contain">
        <div class="about">
            <p class="txt">О себе</p>
            <p class="txt_mini">{{ $artist->bio ?? 'Информация о мастере скоро появится...' }}</p>
        </div>
    </div>

    <!-- Работы мастера -->
    @if($artist->portfolios->count() > 0)
        <div class="works">
            <p>Работы</p>
            <div class="pictures">
                @foreach($artist->portfolios->chunk(3) as $chunk)
                    <div class="f_row">
                        @foreach($chunk as $work)
                            <img src="{{ Storage::disk('public')->url($work->image_path) }}" alt="{{ $work->title }}">
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Отзывы -->
    <div class="feedbacks">
        <p>Отзывы</p>

        <!-- Форма добавления отзыва -->
        @auth
            <div class="feedback-form">
                <h3>Оставить отзыв</h3>
                <form method="POST" action="{{ route('artists.feedback.store', $artist->id) }}">
                    @csrf
                    <div class="rating-buttons">
                        <button type="button" class="rating-btn positive" onclick="setRating(true)">
                            👍 Положительный
                        </button>
                        <button type="button" class="rating-btn negative" onclick="setRating(false)">
                            👎 Отрицательный
                        </button>
                    </div>
                    <input type="hidden" name="rating_positive" id="rating_positive" required>
                    <textarea name="comment" placeholder="Расскажите о вашем опыте..." required></textarea>
                    <button type="submit" class="submit-btn">Отправить отзыв</button>
                </form>
            </div>
        @else
            <div class="reg_for_feedback">
                <p>Чтобы оставить отзыв, <a href="{{ route('auth.form') }}">войдите в систему</a></p>
            </div>
        @endauth

        <!-- Список отзывов -->
        <div class="feedback-list">
            @if($positiveFeedbacks->count() > 0 || $negativeFeedbacks->count() > 0)
                <!-- Положительные отзывы -->
                @foreach($positiveFeedbacks as $feedback)
                    <div class="feedback-item">
                        <div class="feedback-header">
                            @if($feedback->user->avatar)
                                <img src="{{ Storage::disk('public')->url($feedback->user->avatar->file_path) }}" alt="{{ $feedback->user->username }}" class="feedback-avatar">
                            @else
                                <div class="feedback-avatar" style="background: #ddd; display: flex; align-items: center; justify-content: center; color: #666;">
                                    {{ substr($feedback->user->username, 0, 1) }}
                                </div>
                            @endif
                            <span class="feedback-user">{{ $feedback->user->username }}</span>
                            <span class="feedback-rating rating-positive">Положительный</span>
                        </div>
                        <div class="feedback-comment">{{ $feedback->comment }}</div>
                    </div>
                @endforeach

                <!-- Отрицательные отзывы -->
                @foreach($negativeFeedbacks as $feedback)
                    <div class="feedback-item">
                        <div class="feedback-header">
                            @if($feedback->user->avatar)
                                <img src="{{ Storage::disk('public')->url($feedback->user->avatar->file_path) }}" alt="{{ $feedback->user->username }}" class="feedback-avatar">
                            @else
                                <div class="feedback-avatar" style="background: #ddd; display: flex; align-items: center; justify-content: center; color: #666;">
                                    {{ substr($feedback->user->username, 0, 1) }}
                                </div>
                            @endif
                            <span class="feedback-user">{{ $feedback->user->username }}</span>
                            <span class="feedback-rating rating-negative">Отрицательный</span>
                        </div>
                        <div class="feedback-comment">{{ $feedback->comment }}</div>
                    </div>
                @endforeach
            @else
                <div class="no-feedbacks">
                    Пока нет отзывов. Будьте первым!
                </div>
            @endif
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

<script>
    function setRating(isPositive) {
        document.getElementById('rating_positive').value = isPositive ? '1' : '0';

        // Убираем активный класс со всех кнопок
        document.querySelectorAll('.rating-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Добавляем активный класс к выбранной кнопке
        if (isPositive) {
            document.querySelector('.rating-btn.positive').classList.add('active');
        } else {
            document.querySelector('.rating-btn.negative').classList.add('active');
        }
    }

    // Инициализация при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInput = document.getElementById('rating_positive');
        if (ratingInput.value) {
            setRating(ratingInput.value === '1');
        }
    });
</script>
</body>
</html>
