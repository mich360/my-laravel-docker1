<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 注文一覧
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // ログイン中ユーザーの注文のみ取得
        $orders = Order::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('orders.index', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | 注文詳細
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        // ログインユーザーの注文のみ表示可能
        $order = Order::with('orderItems.item')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | 注文確定
    |--------------------------------------------------------------------------
    */

    public function checkout(Request $request)
    {
        // ログイン確認
        if (!Auth::check()) {

            return redirect()
                ->route('login')
                ->with('error', 'ログインしてください');
        }

        // セッションカート取得
        $cart = session()->get('cart', []);

        // 空カート防止
        if (count($cart) === 0) {

            return redirect()
                ->route('cart.index')
                ->with('error', 'カートが空です');
        }

        /*
        |--------------------------------------------------------------------------
        | 合計金額計算
        |--------------------------------------------------------------------------
        */

        $total = 0;

        foreach ($cart as $item) {

            $subtotal = $item['price'] * $item['quantity'];

            $total += $subtotal;
        }

        /*
        |--------------------------------------------------------------------------
        | 注文作成
        |--------------------------------------------------------------------------
        */

        $order = Order::create([

            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 注文明細作成
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $itemId => $item) {

            OrderItem::create([

                'order_id' => $order->id,
                'item_id' => $itemId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | カート削除
        |--------------------------------------------------------------------------
        */

        session()->forget('cart');

        /*
        |--------------------------------------------------------------------------
        | 注文詳細へ
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', '注文が完了しました');
    }
}