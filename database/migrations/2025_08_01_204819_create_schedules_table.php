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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id')            // 映画ID
                  ->index()
                  ->comment('movies.id への外部キー');
            $table->time('start_time')->comment('上映開始時刻');
            $table->time('end_time')->comment('上映終了時刻');

            // 外部キー制約
            $table->foreign('movie_id')
                  ->references('id')
                  ->on('movies')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
