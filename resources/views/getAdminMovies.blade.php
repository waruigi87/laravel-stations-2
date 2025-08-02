{{-- resources/views/getAdminMovies.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画一覧（管理画面）</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>画像</th>
                <th>公開年</th>
                <th>説明</th>
                <th>状態</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>
                        <img 
                            src="{{ $movie->image_url }}" 
                            alt="{{ $movie->title }}" 
                            style="max-width: 100px; height: auto;"
                        >
                    </td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                    <td>
                        {{-- 編集ボタン --}}
                        <a 
                            href="{{ url('admin/movies/'.$movie->id.'/edit') }}" 
                            class="btn btn-sm btn-primary"
                        >
                            編集
                        </a>

                        {{-- 削除フォーム --}}
                        <form
                            action="{{ url('admin/movies/'.$movie->id.'/destroy') }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('本当に削除しますか？');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                削除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

