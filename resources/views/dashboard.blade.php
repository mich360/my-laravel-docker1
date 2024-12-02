<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br>
                    <!-- 商品一覧ページへのリンク -->
                    <a href="{{ route('items.index') }}" class="text-blue-500 hover:underline">商品一覧</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
4. HTML に適用
Blade ファイル内で、CSS を適用するタグを追加します。例えば：

blade
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
または、vite を使用している場合：
blade

@vite('resources/css/app.css')
 -->
