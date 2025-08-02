@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $movie->title }}</h1>
    
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="img-fluid">
    
    <p><strong>公開年:</strong> {{ $movie->published_year }}</p>
    <p><strong>説明:</strong> {{ $movie->description }}</p>

    <h2 class="mt-4">上映スケジュール</h2>
    <div class="schedules">
        @foreach($movie->schedules as $schedule)
            <div class="schedule-item">
                <span>{{ $schedule->start_time->format('H:i') }}</span> - 
                <span>{{ $schedule->end_time->format('H:i') }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection
