<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ProductController;

//Товары
Route::get('/', [ProductController::class, 'index']);

//Авторизация
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'checkLogin']);
Route::get('/reg',[AuthController::class, 'showReg']);
Route::post('/reg',[AuthController::class, 'checkReg']);

//Профиль

Route::get('/profile', [MainController::class, 'showProfile']);












//Ошибка
Route::get('/error', function (){ return Inertia::render('Error'); });




// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
