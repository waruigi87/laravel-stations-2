<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;

Route::get('/', fn() => view('welcome'));

// 公開側
Route::get('/movies', [MovieController::class,'getMovies'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class,'show'])->name('movies.show');

// 座席表
Route::get('/sheets', [SheetController::class,'index'])->name('sheets.index');

// 管理画面
Route::prefix('admin')->name('admin.')->group(function() {
    // ── 映画 ──
    Route::get('movies',              [MovieController::class,'getAdminMovies'])->name('movies.index');

    // create は必ず {id} より先
    Route::get('movies/create',       [MovieController::class,'createMovie'])->name('movies.create');
    Route::post('movies/store',       [MovieController::class,'storeMovie'])->name('movies.store');

    Route::get('movies/{id}',         [MovieController::class,'showAdminMovie'])->name('movies.show');
    Route::get('movies/{id}/edit',    [MovieController::class,'editMovie'])->name('movies.edit');

    // テストは PATCH で叩くので PATCH だけ定義
    Route::patch('movies/{id}/update', [MovieController::class,'updateMovie'])->name('movies.update');
    Route::delete('movies/{id}/destroy',[MovieController::class,'deleteMovie'])->name('movies.destroy');

    // ── スケジュール ──
    Route::get('schedules',                       [ScheduleController::class,'index'])->name('schedules.index');
    Route::get('schedules/{schedule}',            [ScheduleController::class,'show'])->name('schedules.show');
    Route::get('movies/{movie}/schedules/create', [ScheduleController::class,'create'])->name('schedules.create');
    Route::post('movies/{movie}/schedules/store', [ScheduleController::class,'store'])->name('schedules.store');
    Route::get('schedules/{schedule}/edit',       [ScheduleController::class,'edit'])->name('schedules.edit');
    Route::patch('schedules/{schedule}/update',   [ScheduleController::class,'update'])->name('schedules.update');
    Route::delete('schedules/{schedule}/destroy', [ScheduleController::class,'destroy'])->name('schedules.destroy');
});
