<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>カート</title>
</head>
<body>
    <h1>カートの中身</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($cart as $itemId => $item)
            <li>
                {{ $item['name'] }} - ¥{{ number_format($item['price']) }} x {{ $item['quantity'] }}
                <form action="{{ route('cart.remove', $itemId) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('items.index') }}">商品一覧に戻る</a>
</body>
</html>
