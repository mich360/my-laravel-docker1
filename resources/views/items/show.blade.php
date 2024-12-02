<!DOCTYPE html>
<!-- /Users/user1/Desktop/my-laravel-docker/resources/views/items/show.blade.php-->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $item->name }} - 商品詳細</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('items.index') }}">商品一覧</a></li>
            <li><a href="{{ route('cart') }}">カート</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="item-detail">
        <h1>{{ $item->name }}</h1>
        <div class="item-image">
            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}の画像">
        </div>
        <div class="item-info">
            <p>価格: <strong>{{ $item->price }}円</strong></p>
            <p>{{ $item->description }}</p>
        </div>
        
        <!-- カートに追加するフォーム -->
        <div class="add-to-cart">
            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                @csrf
                <button type="submit">カートに追加</button>
            </form>
        </div>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} 商品詳細ページ</p>
</footer>

</body>
</html>
