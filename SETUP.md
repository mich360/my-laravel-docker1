# my-laravel-docker1 起動手順

## 📁 プロジェクト情報

- **プロジェクト名：** `my-laravel-docker1`
- **場所：** `~/projects/my-laravel-docker1`
- **GitHubリポジトリ：** `https://github.com/mich360/my-laravel-docker1`
- **データベース：** SQLite (`database/database.sqlite`)
- **フレームワーク：** Laravel 10.48.29
- **PHP：** 8.2（Docker: php:8.2-fpm）
- **Webサーバー：** Nginx
- **フロントエンド：**
  - Vite
  - Tailwind CSS
- **開発環境：** Docker Compose

---

## 🚀 起動手順（開発環境）

### 方法1：Docker + Vite（推奨）

現在の開発環境は Docker + Nginx + PHP-FPM + Vite 構成です。

---

### ターミナル1：Docker起動

```bash
cd ~/projects/my-laravel-docker1

docker compose up -d
```

#### ターミナル2：Vite（フロントエンド）

```bash
cd ~/projects/my-laravel-docker1

npm run dev
```

→ Vite 開発サーバー起動
通常：

```code
http://localhost:5173
```

#### アクセスURL

```link
http://localhost/items        # 商品一覧
http://localhost/cart         # カート
http://localhost/login        # ログイン
http://localhost/dashboard    # ダッシュボード
```

### 🛑 Docker停止

```bash
docker compose down
```

###  よく使うコマンド

#### データベース操作（Tinker）

```bash
docker compose exec app php artisan tinker
```

商品追加

```php
   App\Models\Item::create([
    'name' => 'バラ',
    'price' => 1300,
    'image' => 'hana2.JPG',
    'description' => '一重咲きの野生種',
]);

```

商品更新

```php
    $item = App\Models\Item::find(1);

    $item->description = '新しい説明';

    $item->save();

```

Tinker終了

```bash
   exit

   又は

   .quit
```


🗄️ SQLite確認

```bash
  sqlite3 database/database.sqlite
```  

テーブル一覧

```sql
  .tables
```

商品確認

```sql
  SELECT * FROM items;
```

SQLite終了

```sql
   .quit
```

### 🛠️ migration

migration実行

```bash
   docker compose exec app php artisan migrate
```

migration状態確認

```bash
   docker compose exec app php artisan migrate:status
```

### 🛠️ Storageリンク

画像表示用：

```bash
  docker compose exec app php artisan storage:link
```

## 🛠️ Git操作

```txt
  状態確認
git status

変更を追加
git add .

コミット
git commit -m "Update message"

GitHubへpush
git push origin main

📝 開発状況
実装済み機能


✅ 商品一覧表示


✅ 商品詳細表示


✅ 検索機能


✅ カート機能（追加・削除）


✅ ユーザー認証


✅ Session Cart


✅ 商品画像表示


✅ SQLite連携


✅ Docker環境


✅ Vite + Tailwind CSS



⏳ 今後の課題


⏳ 決済機能（Stripe等）


⏳ 注文履歴


⏳ 在庫管理


⏳ 商品管理画面


⏳ MySQL/PostgreSQL対応


⏳ 本番デプロイ



⚠️ 補足
現在は：
Nginx + PHP-FPM + Laravel + SQLite
構成です。
そのため通常：
php artisan serve
は使用せず、
docker compose up -d
を使用します。

最終更新日： 2026年5月22日


---
