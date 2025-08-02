@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール一覧（管理画面）</h1>

    @foreach($movies as $movie)
        <h2>{{ $movie->id }}: {{ $movie->title }}</h2>
        <ul>
            @foreach($movie->schedules as $sch)
                <li>
                    <a href="{{ route('admin.schedules.show', $sch->id) }}">
                        開始: {{ $sch->start_time }} / 終了: {{ $sch->end_time }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
@endsection
