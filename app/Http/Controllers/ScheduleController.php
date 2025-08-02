<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'movie_id',
        'start_time',
        'end_time',
    ];

    // 日時カラムをCarbonインスタンスとして扱う
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // 時刻のみを取得したい場合のアクセサメソッド
    public function getStartTimeOnlyAttribute()
    {
        return $this->start_time ? $this->start_time->format('H:i:s') : null;
    }

    public function getEndTimeOnlyAttribute()
    {
        return $this->end_time ? $this->end_time->format('H:i:s') : null;
    }

    // Movie リレーション
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}