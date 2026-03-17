<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ProductController;

//Товары
Route::redirect('/', '/products');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

//Авторизация
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'checkLogin']);
Route::get('/reg',[AuthController::class, 'showReg']);
Route::post('/reg',[AuthController::class, 'checkReg']);
Route::post('/logout', [AuthController::class, 'logout']);

//Профиль

Route::get('/profile', [MainController::class, 'showProfile']);

//Избранное
Route::middleware(['auth'])->post('/{product}/toggle-favorite', [FavoriteController::class, 'toggle']);

//О игре
Route::get('/product/{product}', [ProductController::class, 'aboutGameModalShow']);








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
