<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>

<h1>商品一覧</h1>

@foreach ($products as $product)

<div style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">

    <h2>{{ $product->name }}</h2>

    @if ($product->image)
        <img src="{{ asset('images/' . $product->image) }}"
             alt="{{ $product->name }}"
             width="200">
    @endif

    <p>{{ $product->description }}</p>

    <p>
        価格:
        {{ number_format($product->price) }}円
    </p>

    <p>
        在庫:
        {{ $product->stock }}
    </p>

</div>

@endforeach

</body>
</html>