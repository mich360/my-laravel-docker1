<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            // 商品名
            $table->string('name');

            // 価格
            $table->integer('price');

            // 商品説明
            $table->text('description')->nullable();

            // 在庫数
            $table->integer('stock')->default(0);

            // 商品画像ファイル名
            // 例: hana1.JPG
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};