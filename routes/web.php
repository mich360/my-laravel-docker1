<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| 商品一覧（旧 Item システム）
|--------------------------------------------------------------------------
*/

Route::get('/items',
    [ItemController::class, 'index']
)->name('items.index');

Route::get('/items/{id}',
    [ItemController::class, 'show']
)->name('items.show');

Route::get('/search',
    [ItemController::class, 'search']
)->name('search');


/*
|--------------------------------------------------------------------------
| Product システム（EC用）
|--------------------------------------------------------------------------
*/

Route::get('/products',
    [ProductController::class, 'index']
)->name('products.index');


/*
|--------------------------------------------------------------------------
| カート
|--------------------------------------------------------------------------
*/

// カート一覧
Route::get('/cart',
    [CartController::class, 'index']
)->name('cart.index');

// カート追加
Route::post('/cart/add/{item}',
    [CartController::class, 'addToCart']
)->name('cart.add');

// カート削除
Route::delete('/cart/remove/{id}',
    [CartController::class, 'removeFromCart']
)->name('cart.remove');

/*
|--------------------------------------------------------------------------
| 注文
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // 注文一覧
    Route::get('/orders',
        [OrderController::class, 'index']
    )->name('orders.index');

    // 注文詳細
    Route::get('/orders/{id}',
        [OrderController::class, 'show']
    )->name('orders.show');

    // 購入処理
    Route::post('/checkout',
        [OrderController::class, 'checkout']
    )->name('orders.checkout');

});


/*
|--------------------------------------------------------------------------
| トップページ
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ダッシュボード
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| プロフィール
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


require __DIR__.'/auth.php';