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
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // 注文ID
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 商品ID（Item）
            $table->foreignId('item_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 数量
            $table->integer('quantity')->default(1);

            // 注文時価格
            $table->integer('price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};