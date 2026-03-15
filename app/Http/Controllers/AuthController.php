<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function showLogin() {
        return Inertia::render('auth/Login');
    }

    public function checkLogin(Request $request) {
        $validated = $request->validate([
            'email' => ['required','max:255','email'],
            'password' => ['required', 'min:6','max:255']
        ]);

        $user = User::where('email',  $validated['email'])->first();
        if($user && Hash::check($validated['password'], $user->password)){
            Auth::login($user, true);
            return redirect()->intended('/')->with('userName', $user->name);
        }
        else{
            return back()->withErrors([
                'password' => 'Неверный логин или пароль.',
            ])->onlyInput('email');
        }
    }

    public function showReg() {
        return Inertia::render('auth/Reg');
    }

    public function checkReg(Request $request) {
        $validated = $request->validate([
            'email' => ['required','max:255','email'],
            'name' => ['required','max:255'],
            'password' => ['required', 'min:6','max:255','confirmed']
        ]);
        $email = User::where('email',  $request->email)->first();
        $name = User::where('name',  $request->name)->first();
        if($email){
            return back()->withErrors([
                'email' => 'Пользователь с таким email уже существует, авторизуйтесь',
            ])->onlyInput('email', 'name', 'password');
        }
        else if($name){
            return back()->withErrors([
                'name' => 'Пользователь с таким именем уже существует, авторизуйтесь',
            ])->onlyInput('email', 'name', 'password');
        }
        else{
            User::create($validated);
            $user = User::where('email',  $validated['email'])->first();
            Auth::login($user, true);
            return redirect()->intended('/')->with('userName', $validated['name']);
        }
    }

    public function logout(Request $request)
    {
        // 1. Стандартный выход Laravel (удаляет привязку юзера к сессии)
        Auth::logout();

        // 2. Полная очистка текущей сессии на сервере
        $request->session()->invalidate();

        // 3. Генерация нового токена CSRF (защита от повторного использования сессии)
        $request->session()->regenerateToken();

        // Перенаправляем на главную или страницу входа
        return redirect('/');
    }

}
