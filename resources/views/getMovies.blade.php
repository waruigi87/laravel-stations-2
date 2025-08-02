{{-- resources/views/getMovies.blade.php --}}
@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style>
        form.search-form {
            margin-bottom: 1em;
        }
        form.search-form input[type="text"] {
            width: 200px;
            padding: 4px;
        }
        form.search-form label {
            margin-right: 1em;
        }
        table.movie-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.movie-table th,
        table.movie-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        table.movie-table th {
            background-color: #f4f4f4;
        }
        table.movie-table img {
            max-width: 120px;
            height: auto;
            display: block;
        }
        .pagination {
            margin-top: 1em;
        }
    </style>
</head>
<body>
    {{-- 検索フォーム --}}
    <form class="search-form" action="{{ url('/movies') }}" method="GET">
        <input 
            type="text" 
            name="keyword" 
            value="{{ request('keyword') }}" 
            placeholder="キーワードで検索（タイトル／あらすじ）"
        >
        <label>
            <input 
                type="radio" 
                name="is_showing" 
                value="" 
                {{ request()->missing('is_showing') ? 'checked' : '' }}
            > 全て
        </label>
        <label>
            <input 
                type="radio" 
                name="is_showing" 
                value="0" 
                {{ request('is_showing') === '0' ? 'checked' : '' }}
            > 公開予定
        </label>
        <label>
            <input 
                type="radio" 
                name="is_showing" 
                value="1" 
                {{ request('is_showing') === '1' ? 'checked' : '' }}
            > 公開中
        </label>
        <button type="submit">検索</button>
    </form>

    {{-- 映画一覧テーブル --}}
    <table class="movie-table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>画像</th>
                <th>公開年</th>
                <th>概要</th>
                <th>状態</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>
                        <img 
                            src="{{ $movie->image_url }}" 
                            alt="{{ $movie->title }}"
                        >
                    </td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ Str::limit($movie->description, 100) }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">該当する映画が見つかりませんでした。</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination">
        {{ $movies->appends(request()->query())->links() }}
    </div>
</body>
</html>
