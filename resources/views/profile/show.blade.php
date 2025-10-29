<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Профиль - All Fine</title>
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.ico">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .avatar-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .avatar-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #333;
        }
        .avatar-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 3px solid #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn-primary {
            background: #333;
            color: white;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
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
        .avatar-actions {
            margin-top: 10px;
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
            <a href="{{ route('profile') }}" style="text-decoration: underline;">Профиль</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">Выйти</button>
            </form>
        </nav>
    </div>
</header>

<main>
    <div class="profile-container">
        <h1>Мой профиль</h1>

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

        {{-- resources/views/profile/index.blade.php --}}

        <!-- ЗАМЕНИТЕ всю форму на эту версию: -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')

            <!-- Аватарка -->
            <div class="avatar-section">
                @if($user->avatar && Storage::disk('public')->exists($user->avatar->file_path))
                    <img src="{{ Storage::disk('public')->url($user->avatar->file_path) }}" alt="Аватар" class="avatar-img">
                    <div class="avatar-actions">
                        <button type="button" onclick="document.getElementById('avatar_input').click()" class="btn btn-secondary">
                            Сменить аватар
                        </button>
                        <button type="button" onclick="deleteAvatar()" class="btn btn-danger">
                            Удалить аватар
                        </button>
                    </div>
                @else
                    <div class="avatar-placeholder">
                        <span>Нет аватарки</span>
                    </div>
                    <div class="avatar-actions">
                        <button type="button" onclick="document.getElementById('avatar_input').click()" class="btn btn-primary">
                            Загрузить аватар
                        </button>
                    </div>
                @endif

                <!-- ВАЖНО: input должен быть ВНУТРИ формы и иметь name="avatar" -->
                <input type="file" id="avatar_input" name="avatar" accept="image/*" style="display: none;">
            </div>

            <!-- Основная информация -->
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" id="email" value="{{ $user->email }}" disabled>
                <small style="color: #666;">Email нельзя изменить</small>
            </div>

            <div class="form-group">
                <label for="username">Имя пользователя *</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Контактная информация -->
            <div class="form-group">
                <label for="phone_number">Номер телефона</label>
                <input type="tel"
                       id="phone_number"
                       name="phone_number"
                       value="{{ old('phone_number', $user->profile->phone_number ?? '') }}"
                       placeholder="+7-999-888-77-66"
                       pattern="^(\+7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                       title="Введите номер в формате: +7-999-888-77-66 или 8-999-888-77-66">
                @error('phone_number')
                <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="messenger_id">Предпочтительный мессенджер</label>
                <select id="messenger_id" name="messenger_id">
                    <option value="">Выберите мессенджер</option>
                    @foreach($messengers as $messenger)
                        <option value="{{ $messenger->id }}"
                            {{ old('messenger_id', $user->profile->messenger_id ?? '') == $messenger->id ? 'selected' : '' }}>
                            {{ $messenger->name }}
                        </option>
                    @endforeach
                </select>
                @error('messenger_id')
                <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="messenger_contact_url">Ссылка на аккаунт в мессенджере</label>
                <input type="url" id="messenger_contact_url" name="messenger_contact_url"
                       value="{{ old('messenger_contact_url', $user->profile->messenger_contact_url ?? '') }}"
                       placeholder="https://t.me/username">
                @error('messenger_contact_url')
                <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Кнопки -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">На главную</a>
            </div>
        </form>

        <script>
            // Обновим JavaScript для новой структуры
            function previewAvatar(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const avatarSection = document.querySelector('.avatar-section');
                        avatarSection.innerHTML = `
                <img src="${e.target.result}" alt="Предпросмотр" class="avatar-img">
                <div class="avatar-actions">
                    <button type="button" onclick="document.getElementById('avatar_input').click()" class="btn btn-secondary">
                        Сменить аватар
                    </button>
                    <button type="button" onclick="deleteAvatar()" class="btn btn-danger">
                        Удалить аватар
                    </button>
                </div>
                <input type="file" id="avatar_input" name="avatar" accept="image/*" style="display: none;" onchange="previewAvatar(this)">
            `;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Обновляем обработчик для нового input
            document.getElementById('avatar_input').addEventListener('change', previewAvatar);

            function deleteAvatar() {
                if (confirm('Вы уверены, что хотите удалить аватарку?')) {
                    fetch('{{ route("profile.avatar.delete") }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Ошибка при удалении аватарки');
                        }
                    });
                }
            }
        </script>
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
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const avatarSection = document.querySelector('.avatar-section');
                avatarSection.innerHTML = `
                        <img src="${e.target.result}" alt="Предпросмотр" class="avatar-img">
                        <div class="avatar-actions">
                            <button type="button" onclick="document.getElementById('avatar').click()" class="btn btn-secondary">
                                Сменить аватар
                            </button>
                            <button type="button" onclick="deleteAvatar()" class="btn btn-danger">
                                Удалить аватар
                            </button>
                        </div>
                        <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;" onchange="previewAvatar(this)">
                    `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteAvatar() {
        if (confirm('Вы уверены, что хотите удалить аватарку?')) {
            fetch('{{ route("profile.avatar.delete") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Ошибка при удалении аватарки');
                }
            });
        }
    }
</script>
</body>
</html>
