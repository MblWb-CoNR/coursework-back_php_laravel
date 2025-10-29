<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/portfolio/artist/{artistId}', [PortfolioController::class, 'byArtist'])->name('portfolio.artist');


//Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');


// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    // временные маршруты

    Route::get('/masters', function () {
        return view('home')->with('message', 'Страница "Мастера" в разработке');
    })->name('masters');

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


