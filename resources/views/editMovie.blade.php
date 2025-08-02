@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画作品編集</h1>

    {{-- フラッシュメッセージ（エラー） --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('admin/movies/'.$movie->id.'/update') }}">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="title">映画タイトル</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title', $movie->title) }}"
                required
            >
        </div>

        <div class="form-group mb-3">
            <label for="genre">ジャンル</label>
            <input
                type="text"
                id="genre"
                name="genre"
                class="form-control"
                value="{{ old('genre', optional($movie->genre)->name) }}"
                required
            >
        </div>


        <div class="form-group mb-3">
            <label for="image_url">画像URL</label>
            <input
                type="text"
                id="image_url"
                name="image_url"
                class="form-control"
                value="{{ old('image_url', $movie->image_url) }}"
                required
            >
        </div>

        <div class="form-group mb-3">
            <label for="published_year">公開年</label>
            <input
                type="number"
                id="published_year"
                name="published_year"
                class="form-control"
                value="{{ old('published_year', $movie->published_year) }}"
                required
            >
        </div>

        <div class="form-group mb-3">
            <label for="description">概要</label>
            <textarea
                id="description"
                name="description"
                class="form-control"
                rows="5"
                required
            >{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="form-check mb-4">
            <input
                type="checkbox"
                id="is_showing"
                name="is_showing"
                class="form-check-input"
                value="1"
                {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="is_showing">
                公開中
            </label>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ url('admin/movies') }}" class="btn btn-secondary ms-2">キャンセル</a>
    </form>
</div>
@endsection
