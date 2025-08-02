{{-- resources/views/admin/movies/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>映画作品登録</h1>

    {{-- フラッシュメッセージ --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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

    <form method="POST" action="{{ route('admin.movies.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="title">映画タイトル</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title') }}"
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
                value="{{ old('genre') }}"
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
                value="{{ old('image_url') }}"
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
                value="{{ old('published_year') }}"
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
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-check mb-4">
            <input
                type="checkbox"
                id="is_showing"
                name="is_showing"
                class="form-check-input"
                value="1"
                {{ old('is_showing') ? 'checked' : '' }}
            >
            <label class="form-check-label" for="is_showing">
                公開中
            </label>
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
</div>
@endsection
