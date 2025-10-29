<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artist->user->username }} - All Fine</title>
    <link rel="stylesheet" href="/css/leoka_style.css">
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

        .leoka {
            display: flex;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto 50px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .leoka img {
            width: 300px;
            height: 300px;
            border-radius: 10px;
            object-fit: cover;
        }

        .name {
            flex: 1;
        }

        .name p {
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .contain {
            max-width: 1200px;
            margin: 0 auto 50px;
        }

        .about {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .txt {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 22pt;
            color: #464646;
            margin-bottom: 20px;
        }

        .txt_mini {
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            line-height: 1.6;
            color: #555;
        }

        .works {
            max-width: 1200px;
            margin: 0 auto;
        }

        .works > p {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 22pt;
            color: #464646;
            margin-bottom: 30px;
            text-align: center;
        }

        .pictures {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .f_row, .s_row {
            display: flex;
            gap: 30px;
            justify-content: center;
        }

        .f_row img, .s_row img {
            width: 350px;
            height: 350px;
            border-radius: 10px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .f_row img:hover, .s_row img:hover {
            transform: scale(1.05);
        }

        /* Стили для отзывов */
        .feedbacks {
            max-width: 1200px;
            margin: 50px auto;
        }

        .feedbacks > p {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 22pt;
            color: #464646;
            margin-bottom: 30px;
            text-align: center;
        }

        .feedback-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .feedback-form h3 {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 18pt;
            margin-bottom: 20px;
            color: #464646;
        }

        .rating-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .rating-btn {
            padding: 10px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            background: white;
            cursor: pointer;
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            transition: all 0.3s ease;
        }

        .rating-btn.active {
            border-color: #464646;
            background: #464646;
            color: white;
        }

        .rating-btn.positive.active {
            border-color: #28a745;
            background: #28a745;
        }

        .rating-btn.negative.active {
            border-color: #dc3545;
            background: #dc3545;
        }

        textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            resize: vertical;
            min-height: 100px;
            margin-bottom: 20px;
        }

        .submit-btn {
            padding: 12px 30px;
            background: #464646;
            color: white;
            border: none;
            border-radius: 25px;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 14pt;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #333;
        }

        .feedback-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .feedback-item {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .feedback-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .feedback-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .feedback-user {
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            font-weight: bold;
            color: #464646;
        }

        .feedback-rating {
            padding: 5px 12px;
            border-radius: 15px;
            font-family: "MuseoModerno", sans-serif;
            font-size: 12pt;
            color: white;
        }

        .rating-positive {
            background: #28a745;
        }

        .rating-negative {
            background: #dc3545;
        }

        .feedback-comment {
            font-family: "MuseoModerno", sans-serif;
            font-size: 14pt;
            line-height: 1.6;
            color: #555;
        }

        .no-feedbacks {
            text-align: center;
            font-family: "MuseoModerno", sans-serif;
            font-size: 16pt;
            color: #666;
            padding: 40px;
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
            <a href="{{ route('artists.index') }}">Мастера</a>
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
            <p><strong>Опыт:</strong> 4 года</p>
            <p><strong>Услуги:</strong><br>
                @foreach($artist->prices as $price)
                    - {{ $price->service->name }}: {{ $price->price }} руб.<br>
                @endforeach
            </p>
            <p><strong>Социальные сети:</strong> @{{ $artist->user->username }}</p>
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
            <div style="text-align: center; margin-bottom: 30px;">
                <p>Чтобы оставить отзыв, <a href="{{ route('auth.form') }}" style="color: #464646;">войдите в систему</a></p>
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
