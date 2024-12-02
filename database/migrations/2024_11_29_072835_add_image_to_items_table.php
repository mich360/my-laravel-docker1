<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // itemsテーブルにimageカラムを追加
        Schema::table('items', function (Blueprint $table) {
            $table->string('image')->nullable(); // 画像フィールドを追加（nullを許可）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // itemsテーブルからimageカラムを削除
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('image'); // 画像フィールドを削除
        });
    }
};
