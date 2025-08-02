@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール編集</h1>

    <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <input type="hidden" name="movie_id" value="{{ $schedule->movie_id }}">
        
        <div class="form-group">
            <label for="start_time_date">開始日:</label>
            <input type="date" name="start_time_date" id="start_time_date" 
                   value="{{ $schedule->start_time->format('Y-m-d') }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="start_time_time">開始時刻:</label>
            <input type="time" name="start_time_time" id="start_time_time" 
                   value="{{ $schedule->start_time->format('H:i') }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="end_time_date">終了日:</label>
            <input type="date" name="end_time_date" id="end_time_date" 
                   value="{{ $schedule->end_time->format('Y-m-d') }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="end_time_time">終了時刻:</label>
            <input type="time" name="end_time_time" id="end_time_time" 
                   value="{{ $schedule->end_time->format('H:i') }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('admin.movies.show', $schedule->movie) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
