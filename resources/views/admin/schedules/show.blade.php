@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール詳細: ID {{ $schedule->id }}</h1>

    <p><strong>作品ID:</strong> {{ $schedule->movie_id }}</p>
    <p><strong>開始時刻:</strong> {{ $schedule->start_time }}</p>
    <p><strong>終了時刻:</strong> {{ $schedule->end_time }}</p>
    <p><strong>作成日時:</strong> {{ $schedule->created_at }}</p>
    <p><strong>更新日時:</strong> {{ $schedule->updated_at }}</p>

    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-primary">
        編集
    </a>
    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" class="d-inline"
          onsubmit="return confirm('本当に削除しますか？');">
        @csrf @method('DELETE')
        <button class="btn btn-danger">削除</button>
    </form>
    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">一覧へ戻る</a>
</div>
@endsection
