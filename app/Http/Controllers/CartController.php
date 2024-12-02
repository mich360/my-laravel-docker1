<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CartController extends Controller
{
    // 商品をカートに追加
    public function add($id)
    {
        // 商品IDを基に商品を取得
        $item = Item::find($id);
        
        // アイテムが見つかった場合
        if ($item) {
            // カートにアイテムを追加
            return $this->addToCart($item);
        }

        // アイテムが見つからなかった場合
        return redirect()->route('cart.index')->with('error', '商品が見つかりませんでした');
    }

    // カートの内容を表示
    public function index()
    {
        // セッションからカートの内容を取得
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // アイテムをカートに追加
    public function addToCart(Item $item)
    {
        // セッションにカート情報を保存
        $cart = session()->get('cart', []);

        // アイテムがカートにすでに存在する場合
        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity']++;
        } else {
            // 新しいアイテムをカートに追加
            $cart[$item->id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1
            ];
        }

        // カートをセッションに保存
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'アイテムがカートに追加されました!');
    }

    // カートからアイテムを削除
    public function removeFromCart($id)
    {
        // セッションからカート情報を取得
        $cart = session()->get('cart', []);

        // アイテムがカートに存在する場合
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // カートをセッションに保存
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'アイテムがカートから削除されました!');
    }
}
