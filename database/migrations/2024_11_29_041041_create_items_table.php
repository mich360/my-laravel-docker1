<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * マイグレーション: items テーブルの作成
 */
class CreateItemsTable extends Migration
{
    /**
     * テーブルを作成する
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
    /**
     * テーブルを削除する
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
