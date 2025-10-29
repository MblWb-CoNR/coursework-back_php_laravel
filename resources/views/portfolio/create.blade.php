<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавить работу - All Fine</title>
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

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .form-title {
            font-family: "ISOCPEUR", sans-serif;
            font-size: 27pt;
            text-align: center;
            margin: 40px 0;
            color: #464646;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-family: "ISOCPEUR", sans-serif;
            font-size: 16pt;
            color: #464646;
        }

        input, select, textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 14pt;
            font-family: "MuseoModerno", sans-serif;
            background: white;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #464646;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16pt;
            margin-right: 15px;
            font-family: "ISOCPEUR", sans-serif;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #464646;
            color: white;
        }

        .btn-primary:hover {
            background: #333;
        }

        .btn-secondary {
            background: #999;
            color: white;
        }

        .btn-secondary:hover {
            background: #777;
        }

        .image-preview {
            max-width: 300px;
            max-height: 300px;
            margin-top: 15px;
            display: none;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .error {
            color: #dc3545;
            font-family: "MuseoModerno", sans-serif;
            font-size: 12pt;
            margin-top: 5px;
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

        .error-message {
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
            <a href="{{ route('masters') }}">Мастера</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('sign_up') }}">Запись</a>
            @auth
                <a href="{{ route('profile') }}">Профиль</a>
                <a href="{{ route('portfolio.create') }}" style="text-decoration: underline;">Добавить работу</a>
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
    <div class="form-container">
        <h1 class="form-title">Добавить работу в портфолио</h1>

        @if(session('error'))
            <div class="message error-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="artist_id">Мастер *</label>
                <select id="artist_id" name="artist_id" required>
                    <option value="">Выберите мастера</option>
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                            {{ $artist->user->username }}
                        </option>
                    @endforeach
                </select>
                @error('artist_id')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Изображение работы *</label>
                <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(this)">
                <img id="imagePreview" class="image-preview" src="#" alt="Предпросмотр">
                @error('image')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Название работы *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Например: Цветочный орнамент">
                @error('title')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Описание работы</label>
                <textarea id="description" name="description" placeholder="Описание стиля, техники, особенностей...">{{ old('description') }}</textarea>
                @error('description')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Добавить работу</button>
                <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
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
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
</body>
</html>
