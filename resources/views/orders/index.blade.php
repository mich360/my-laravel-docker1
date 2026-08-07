<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文一覧</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            padding:20px;
        }

        h1{
            text-align:center;
            margin-bottom:30px;
        }

        .order-card{
            background:white;
            padding:20px;
            margin-bottom:20px;
            border-radius:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        }

        .order-card p{
            margin:8px 0;
        }

        .detail-link{
            display:inline-block;
            margin-top:10px;
            padding:8px 12px;
            background:#3490dc;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .detail-link:hover{
            background:#2779bd;
        }

        .back-link{
            display:inline-block;
            margin-top:20px;
        }
    </style>
</head>
<body>

<h1>注文一覧</h1>

@forelse($orders as $order)

<div class="order-card">

    <p><strong>注文ID:</strong> {{ $order->id }}</p>

    <p><strong>合計金額:</strong>
        {{ number_format($order->total_price) }}円
    </p>

    <p><strong>状態:</strong>
        {{ $order->status }}
    </p>

    <a class="detail-link"
       href="{{ route('orders.show', $order->id) }}">
        注文詳細を見る
    </a>

</div>

@empty

<p>注文データがありません。</p>

@endforelse

<a class="back-link"
   href="{{ route('items.index') }}">
   商品一覧へ戻る
</a>

</body>
</html>