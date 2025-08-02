@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール作成</h1>

    <form action="{{ route('admin.schedules.store', $movie) }}" method="POST">
        @csrf
        
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
        
        <div class="form-group">
            <label for="start_time_date">開始日:</label>
            <input type="date" name="start_time_date" id="start_time_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="start_time_time">開始時刻:</label>
            <input type="time" name="start_time_time" id="start_time_time" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="end_time_date">終了日:</label>
            <input type="date" name="end_time_date" id="end_time_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="end_time_time">終了時刻:</label>
            <input type="time" name="end_time_time" id="end_time_time" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">作成</button>
        <a href="{{ route('admin.movies.show', $movie) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
