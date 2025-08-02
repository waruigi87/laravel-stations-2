@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画詳細（管理画面）: {{ $movie->title }}</h1>

    <p><strong>ID:</strong> {{ $movie->id }}</p>
    <p><strong>公開年:</strong> {{ $movie->published_year }}</p>
    <p><strong>説明:</strong> {{ $movie->description }}</p>
    <p><strong>状態:</strong> {{ $movie->is_showing ? '上映中' : '上映予定' }}</p>

    <h2 class="mt-4">スケジュール一覧</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>スケジュールID</th>
                <th>開始時刻</th>
                <th>終了時刻</th>
                <th>作成日時</th>
                <th>更新日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movie->schedules as $schedule)
                <tr>
                    <td>
                        <a href="{{ route('admin.schedules.show', $schedule) }}">
                            {{ $schedule->id }}
                        </a>
                    </td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>{{ $schedule->created_at ?: '' }}</td>
                    <td>{{ $schedule->updated_at ?: '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a 
      href="{{ route('admin.schedules.create', $movie) }}" 
      class="btn btn-primary"
    >
      新しいスケジュールを追加
    </a>
</div>
@endsection
