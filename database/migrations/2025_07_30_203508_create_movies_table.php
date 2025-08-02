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
        Schema::create('movies', function (Blueprint $table) {
            $table->id()->unique()->comment('映画ID'); // id: 映画ID
            $table->unsignedBigInteger('genre_id')
                ->nullable()         // ← ここを追加
                ->comment('ジャンルID');
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade'); // ← ここを追加
            $table->string('title', 255)
              ->unique()
              ->comment('映画タイトル');  // title: 映画タイトル
            $table->text('image_url')->comment('画像URL');    // ← ここを追加
            $table->year('published_year')->comment('公開年'); // ← ここを追加
            $table->text('description')->comment('概要');     // ← ここを追加
            $table->boolean('is_showing')->default(false)->comment('上映中かどうか'); // ← ここを追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
