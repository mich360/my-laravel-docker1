# my-laravel-docker1 起動手順

## 📁 プロジェクト情報

- **プロジェクト名：** `my-laravel-docker1`
- **場所：** `~/projects/my-laravel-docker1`
- **GitHubリポジトリ：** `https://github.com/mich360/my-laravel-docker1`
- **データベース：** SQLite (`my_database.db`)
- **フレームワーク：** Laravel 10.48.29
- **PHP：** 8.5.0

---

## 🚀 起動手順（開発環境）

### 方法1：開発サーバー（推奨）

#### ターミナル1：Laravelサーバー
```bash
cd ~/projects/my-laravel-docker1
php artisan serve
```
→ `http://127.0.0.1:8000` で起動（または8001）

#### ターミナル2：Vite（フロントエンド）
```bash
cd ~/projects/my-laravel-docker1
npm run dev
```
→ `http://localhost:5174` で起動

#### アクセスURL
```
http://localhost:8000/items        # 商品一覧
http://localhost:8000/cart         # カート
http://localhost:8000/login        # ログイン
http://localhost:8000/dashboard    # ダッシュボード
```

---

### 方法2：Docker（本番環境テスト）
```bash
cd ~/projects/my-laravel-docker1
docker-compose up -d
```

#### アクセスURL
```
http://localhost/index.php/items   # 商品一覧
http://localhost/index.php/cart    # カート
http://localhost/index.php/login   # ログイン
```

#### 停止
```bash
docker-compose down
```

---

## 🛠️ よく使うコマンド

### データベース操作
```bash
# Tinker起動
php artisan tinker

# 商品追加
App\Models\Item::create([
    'name' => 'さつき',
    'price' => 4000,
    'image' => 'hana1.JPG',
    'description' => 'ツツジに比べ咲く時期が１ケ月早い',
]);

# 商品更新
$item = App\Models\Item::find(1);
$item->description = '新しい説明';
$item->save();

# Tinker終了
exit
```

### Git操作
```bash
# 状態確認
git status

# 変更をステージング
git add .

# コミット
git commit -m "Update message"

# プッシュ
git push origin main
```

---

## 📝 開発状況

### 実装済み機能
- ✅ 商品一覧表示
- ✅ 商品詳細表示
- ✅ 検索機能
- ✅ カート機能（追加・削除）
- ✅ ユーザー認証

### 今後の課題
- ⏳ 決済機能
- ⏳ 注文履歴
- ⏳ MySQLへの移行

---

**最終更新日：** 2026年2月14日
