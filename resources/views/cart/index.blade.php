<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>カート</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
           
        }
        main{
       
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
          
        }
        header nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
            background-color: #333;
            color: blue;
            padding: 10px 20px;
        }
        header nav ul li {
            display: inline;
            margin-right: 15px;
        }
        header nav ul li a {
            color: blue;
            text-decoration: none;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        li {
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        p {
            margin: 5px 0;
        }
        button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #d32f2f;
        }
    
    </style>
</head>
<body>
    <main>
<header>
    <nav>
        <ul class="nav-list">
            @auth
                <li>{{ Auth::user()->name }}さん</li>
                <li class="logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            @endauth
            <li><a href="{{ route('items.index') }}">商品一覧</a></li>
        </ul>
    </nav>
</header>

<h1>カートの中身</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<ul>
    @php $total = 0; @endphp <!-- 合計金額の初期化 -->
    @foreach($cart as $itemId => $item)
        @php $total += $item['price'] * $item['quantity']; @endphp <!-- 合計金額を計算 -->
        <li>
            {{ $item['name'] }} - ¥{{ number_format($item['price']) }} x 
            <form action="{{ route('cart.update', $itemId) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 50px;">
                <button type="submit">更新</button>
            </form>
            <form action="{{ route('cart.remove', $itemId) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </li>
    @endforeach
</ul>

<p><strong>合計金額: ¥{{ number_format($total) }}</strong></p> <!-- 合計金額を表示 -->

<a href="{{ route('items.index') }}">商品一覧に戻る</a>
</main>
</body>
</html>
