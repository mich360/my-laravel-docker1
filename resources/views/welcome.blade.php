<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>花ショップ</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-4xl font-bold text-center mb-8">
        花ショップ
    </h1>

    <div class="flex justify-center gap-4">

        <a href="{{ route('items.index') }}"
           class="bg-blue-500 text-white px-6 py-3 rounded">
            商品一覧
        </a>

        <a href="{{ route('cart.index') }}"
           class="bg-green-500 text-white px-6 py-3 rounded">
            カート
        </a>

        <a href="{{ route('orders.index') }}"
           class="bg-purple-500 text-white px-6 py-3 rounded">
            注文一覧
        </a>

    </div>

</div>

</body>
</html>