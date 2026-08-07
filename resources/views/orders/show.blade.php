<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文詳細</title>
</head>
<body>

<h1>注文詳細</h1>

<p>注文ID: {{ $order->id }}</p>

<p>
    合計金額:
    {{ number_format($order->total_price) }}円
</p>

<p>状態: {{ $order->status }}</p>

<p>作成日時: {{ $order->created_at }}</p>

<hr>

<h2>購入商品</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>商品名</th>
        <th>画像</th>
        <th>価格</th>
        <th>数量</th>
        <th>小計</th>
    </tr>

    @foreach ($order->orderItems as $item)

    <tr>

        <td>
            {{ $item->item->name }}
        </td>

        <td>
            <img
                src="{{ asset('images/' . ($item->item->image ?? 'default.jpg')) }}"
                alt="{{ $item->item->name }}"
                width="120"
            >
        </td>

        <td>
            {{ number_format($item->price) }}円
        </td>

        <td>
            {{ $item->quantity }}
        </td>

        <td>
            {{ number_format($item->price * $item->quantity) }}円
        </td>

    </tr>

    @endforeach

</table>

<br>

<a href="{{ route('orders.index') }}">
    注文一覧へ戻る
</a>

</body>
</html>