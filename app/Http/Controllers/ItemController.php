<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    // 商品一覧を表示
    public function index()
    {
        // 商品データの取得
        $items = Item::all();
        
        // 商品一覧ビューに渡す
        return view('items.index', compact('items'));
    }

    // 商品詳細を表示
    public function show($id)
    {
        try {
            // 商品IDに基づいて商品を取得（存在しない場合はModelNotFoundExceptionがスローされる）
            $item = Item::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // 商品が見つからない場合の処理（例：404ページを表示）
            return redirect()->route('items.index')->with('error', '商品が見つかりません');
        }

        // 商品詳細ページを表示
        return view('items.show', compact('item'));
    }

    // 新しい商品を保存する
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048', // 画像のバリデーションを追加
            'description' => 'nullable|string',
        ]);

        // 新しい商品データを保存
        $item = new Item;
        $item->name = $validated['name'];
        $item->price = $validated['price'];
        $item->description = $validated['description'] ?? '商品説明なし'; // デフォルト説明

        // 画像の保存（ファイルがあれば）
        if ($request->hasFile('image')) {
            // 画像ファイルを public/images フォルダに保存
            $imagePath = $request->file('image')->storeAs('images', 'hana1.JPG', 'public'); // ファイル名を 'hana1.JPG' として保存
            $item->image = $imagePath; // 保存した画像のパスをモデルに設定
        } else {
            // 画像がない場合はデフォルトの画像を設定
            $item->image = 'images/default.jpg'; // デフォルト画像のパス
        }

        // 保存
        $item->save();

        // 商品一覧ページにリダイレクト
        return redirect()->route('items.index')->with('success', '商品が保存されました');
    }

    // カートにアイテムを追加
    public function addToCart($id)
    {
        // 商品IDに基づいて商品を取得
        $item = Item::findOrFail($id);

        // セッションにカートデータを保存（簡易的なカート処理）
        $cart = session()->get('cart', []);

        // 商品がすでにカートに存在する場合、数量を増加
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        // カートページにリダイレクト（カート機能が未実装の場合、商品一覧ページにリダイレクト）
        return redirect()->route('cart')->with('success', '商品がカートに追加されました');
    }

    // 検索機能（簡易的な実装）
    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where('name', 'like', "%{$query}%")->get();

        return view('items.index', compact('items'));
    }
}
