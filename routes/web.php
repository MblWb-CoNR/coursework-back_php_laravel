<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/portfolio/artist/{artistId}', [PortfolioController::class, 'byArtist'])->name('portfolio.artist');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artists/{id}', [ArtistController::class, 'show'])->name('artists.show');
Route::post('/artists/{id}/feedback', [ArtistController::class, 'storeFeedback'])->name('artists.feedback.store');

//Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');

Route::get('/create-test-prices', function () {
    $artists = \App\Models\Artist::all();
    $services = \App\Models\Service::all();

    $createdCount = 0;

    foreach ($artists as $artist) {
        foreach ($services as $service) {
            // Проверяем, не существует ли уже такая запись
            $existingPrice = \App\Models\Price::where('artist_id', $artist->id)
                ->where('service_id', $service->id)
                ->first();

            if (!$existingPrice) {
                \App\Models\Price::create([
                    'artist_id' => $artist->id,
                    'service_id' => $service->id,
                    'price' => rand(1000, 5000)
                ]);
                $createdCount++;
            }
        }
    }

    return "Test prices created/checked! New prices: $createdCount, Total prices: " . \App\Models\Price::count();
});

Route::get('/create-test-feedbacks', function () {
    // Очистим существующие отзывы
    \App\Models\Feedback::truncate();

    $artists = \App\Models\Artist::all();
    $users = \App\Models\User::where('id', '!=', 1)->get(); // Все кроме админа

    $commentsPositive = [
        'Отличный мастер! Очень аккуратная работа.',
        'Очень доволен результатом, буду рекомендовать друзьям.',
        'Профессионал своего дела, работа выполнена качественно.',
        'Приятный в общении мастер, комфортная атмосфера.',
    ];

    $commentsNegative = [
        'Не понравилось отношение мастера к работе.',
        'Результат не соответствует ожиданиям.',
        'Долго делал, постоянно отвлекался.',
    ];

    $createdCount = 0;

    foreach ($artists as $artist) {
        // 2-3 положительных отзыва
        for ($i = 0; $i < rand(2, 3); $i++) {
            \App\Models\Feedback::create([
                'user_id' => $users->random()->id,
                'artist_id' => $artist->id,
                'rating_positive' => true,
                'comment' => $commentsPositive[array_rand($commentsPositive)]
            ]);
            $createdCount++;
        }

        // 0-1 отрицательных отзыва
        if (rand(0, 1)) {
            \App\Models\Feedback::create([
                'user_id' => $users->random()->id,
                'artist_id' => $artist->id,
                'rating_positive' => false,
                'comment' => $commentsNegative[array_rand($commentsNegative)]
            ]);
            $createdCount++;
        }
    }

    return "Test feedbacks created! Count: $createdCount";
});

Route::get('/create-test-styles', function () {
    // Сначала очистим существующие стили
    \App\Models\ArtistStyle::truncate();

    $artists = \App\Models\Artist::all();

    $styles = [
        'графика',
        'нью скул',
        'олд скул',
        'японизм',
        'блэкворк',
        'минимализм'
    ];

    $createdCount = 0;

    foreach ($artists as $artist) {
        // Каждому мастеру 1-2 случайных стиля
        $styleCount = rand(1, 2);
        $selectedStyles = array_rand($styles, $styleCount);

        if (!is_array($selectedStyles)) {
            $selectedStyles = [$selectedStyles];
        }

        foreach ($selectedStyles as $styleIndex) {
            \App\Models\ArtistStyle::create([
                'artist_id' => $artist->id,
                'style_name' => $styles[$styleIndex]
            ]);
            $createdCount++;
        }
    }

    return "Test styles created! Count: $createdCount";
});

Route::get('/check-tables', function () {
    $tables = [
        'artists',
        'users',
        'artist_styles',
        'portfolios',
        'prices',
        'services',
        'avatars',
        'feedbacks'
    ];

    $results = [];
    foreach ($tables as $table) {
        try {
            $exists = \Schema::hasTable($table);
            $count = $exists ? \DB::table($table)->count() : 0;
            $results[$table] = [
                'exists' => $exists,
                'count' => $count
            ];
        } catch (\Exception $e) {
            $results[$table] = [
                'exists' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    return $results;
});


// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::get('/add-work', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');


    // временные маршруты

    Route::get('/contacts', function () {
        return view('home')->with('message', 'Страница "Контакты" в разработке');
    })->name('contacts');

    Route::get('/sign_up', function () {
        if (!Auth::check()) {
            return redirect()->route('auth.form')->with('error', 'Для записи необходимо войти в систему');
        }
        return view('home')->with('message', 'Страница "Запись" в разработке');
    })->name('sign_up');
});


