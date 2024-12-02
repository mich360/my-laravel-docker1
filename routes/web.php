<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


// 仮のカートルート設定
Route::get('/cart/add', function () {
    return "仮のカート追加処理です。";
})->name('cart.add');


// use App\Http\Controllers\CartController;

// 商品一覧ページのルート
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// 商品詳細ページのルート
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

// 検索機能のルート
Route::get('/search', [ItemController::class, 'search'])->name('search');

// カートの内容を表示するルート
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// 商品詳細ページからカートに追加するルート
// Route::post('/cart/add/{item}', [CartController::class, 'addToCart'])->name('cart.add');

// 他のルート（ログイン、プロフィールなど）
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
