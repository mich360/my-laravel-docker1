<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カート</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- ヘッダー -->
    <header class="bg-white shadow">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">
                ショッピングカート
            </h1>

            <a href="{{ route('items.index') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                商品一覧へ
            </a>
        </div>
    </header>

    <!-- メイン -->
    <main class="max-w-5xl mx-auto p-4">

        <!-- 成功メッセージ -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- 空カート -->
        @if(count($cart) === 0)

            <div class="bg-white rounded shadow p-8 text-center">
                <p class="text-gray-600 text-lg">
                    カートは空です。
                </p>

                <a href="{{ route('items.index') }}"
                   class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    商品を見る
                </a>
            </div>

        @else

            @php
                $total = 0;
            @endphp

            <!-- カート一覧 -->
            <div class="space-y-4">

                @foreach($cart as $itemId => $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <div class="bg-white rounded shadow p-4 flex justify-between items-center">

                        <!-- 商品情報 -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ $item['name'] }}
                            </h2>

                            <p class="text-gray-600">
                                価格: ¥{{ number_format($item['price']) }}
                            </p>

                            <p class="text-gray-600">
                                数量: {{ $item['quantity'] }}
                            </p>

                            <p class="text-lg font-bold text-red-500 mt-2">
                                小計: ¥{{ number_format($subtotal) }}
                            </p>
                        </div>

                        <!-- 削除ボタン -->
                        <form action="{{ route('cart.remove', $itemId) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                削除
                            </button>
                        </form>

                    </div>

                @endforeach

            </div>

            <!-- 合計 -->
            <div class="mt-8 bg-white rounded shadow p-6 text-right">

                <p class="text-2xl font-bold text-gray-800">
                    合計:
                    <span class="text-red-500">
                        ¥{{ number_format($total) }}
                    </span>
                </p>

                <button class="mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded text-lg">
                    購入手続きへ
                </button>

            </div>

        @endif

    </main>

</body>
</html>