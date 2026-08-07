# my-laravel-docker1 — プロジェクト解説

Laravel + Docker + Vite で構築する ECサイト の構造まとめ

**スタック：** Laravel (PHP) / Docker / Vite / ECサイト

---

## MVCパターンとは

MVC（Model-View-Controller）は、ソフトウェア設計のパターンです。

| コンポーネント | 役割 |
|---|---|
| **Model（モデル）** | データとビジネスロジックを担当。DBとのやりとりはすべてここで行う。 |
| **View（ビュー）** | 画面表示を担当。Bladeテンプレートを使ってHTMLを生成する。 |
| **Controller（コントローラー）** | ModelとViewの仲介役。ルートからリクエストを受け取り、処理を振り分ける。 |

### MVCのメリット

1. **修正が楽** — デザイン変更はViewだけ。Modelを壊す心配がない。
2. **分業しやすい** — デザイナーはView、エンジニアはModelと担当を分けて並行開発できる。
3. **再利用しやすい** — 同じModelをスマホ用・PC用など複数のViewで使い回せる。

---

## Laravelのリクエスト処理フロー

```
ブラウザ
  ↓
routes/web.php
  ↓
Controller
  ↓
Model
  ↓
SQLite
  ↓
Controller
  ↓
Blade (View)
  ↓
ブラウザ表示
```

---

## ファイル構成と役割

### ① `routes/web.php` — URLの受付

```php
Route::get('/items', [ItemController::class, 'index']);
```

`/items` へのアクセスを受け取り、`ItemController` の `index()` を呼び出す。

---

### ② `app/Http/Controllers/ItemController.php` — 処理の司令塔

```php
public function index()
{
    $items = Item::all();
    return view('items.index', compact('items'));
}
```

DBから商品を取得し、Bladeへ渡す。RouteとModel/Viewをつなぐ仲介役。

---

### ③ `app/Models/` — DB操作

```php
class Item extends Model

Item::all()      // 全件取得
Item::find(1)    // 1件取得
Item::create()   // 新規作成
```

SQLをLaravel風に簡単化。

**現在のモデル：** `Item` / `Cart` / `Order` / `OrderItem` / `User`

---

### ④ `database/migrations/` — DB設計図

```php
Schema::create('orders', function (Blueprint $table) {
    // ...
});
```

```bash
php artisan migrate
```

`php artisan migrate` を実行するとSQLite/MySQLに実際のテーブルが作成される。

---

### ⑤ `resources/views/` — 画面HTML（Blade）

```blade
{{-- items/index.blade.php --}}
@foreach($items as $item)
    <p>{{ $item->name }}</p>
@endforeach
```

Bladeテンプレートでデータを受け取り、HTMLとして表示する。

---

### ⑥ `database/database.sqlite` — データベース

**現在のテーブル：** `items` / `carts` / `orders` / `order_items` / `users`

---

## 現在の進捗

以下の実装がすでに完了しています：

| 機能 | 説明 | 状態 |
|---|---|---|
| **CRUD** | データ操作の基本4機能（作成・読取・更新・削除） | ✅ 完了 |
| **Migration** | データベースの設計図をコードで管理する仕組み | ✅ 完了 |
| **Routing** | URLと処理を結びつける仕組み | ✅ 完了 |
| **MVC** | アプリの代表的な設計構造 | ✅ 完了 |
| **Relation** | テーブル同士の関連付け | ✅ 完了 |
