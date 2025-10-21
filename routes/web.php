<?php

<<<<<<< HEAD

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/auth', [AuthController::class, 'showAuthForm'])->name('auth.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    // В routes/web.php добавляем временные маршруты
    Route::get('/works', function () {
        return view('home')->with('message', 'Страница "Работы" в разработке');
    })->name('works');

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
=======
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
>>>>>>> 44cb65d (migrations and models)
});
