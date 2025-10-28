<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showAuthForm()
    {
        // Если пользователь уже авторизован, перенаправляем
        if (Auth::check()) {
            return redirect()->route('profile');
        }

        return view('auth');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.form')
                ->withErrors($validator, 'register')
                ->withInput()
                ->with('active_tab', 'register');
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'role_id' => Role::where('name', 'user')->first()->id,
            ]);

            UserProfile::create([
                'user_id' => $user->id,
            ]);

            DB::commit();

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Регистрация прошла успешно!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('auth.form')
                ->with('error', 'Ошибка при регистрации: ' . $e->getMessage())
                ->with('active_tab', 'register')
                ->withInput();
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_login' => 'required|email',
            'password_login' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.form')
                ->withErrors($validator, 'login')
                ->withInput()
                ->with('active_tab', 'login');
        }

        $credentials = [
            'email' => $request->email_login,
            'password' => $request->password_login
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Добро пожаловать!');
        }

        return redirect()->route('auth.form')
            ->with('error', 'Неверный email или пароль')
            ->with('active_tab', 'login')
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Вы успешно вышли из системы');
    }
}
