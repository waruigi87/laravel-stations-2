<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Movie;
use App\Models\Genre; 
use App\Models\Schedule;

class MovieController extends Controller
{
    
    public function getMovies(Request $request)
    {
        $query = Movie::query();

        // 公開中／公開予定の絞り込み
        if ($request->filled('is_showing')) {
            $query->where('is_showing', $request->input('is_showing'));
        }

        // キーワード検索
        if ($request->filled('keyword')) {
            $kw = $request->input('keyword');
            $query->where(function ($q) use ($kw) {
                $q->where('title', 'like', "%{$kw}%")
                  ->orWhere('description', 'like', "%{$kw}%");
            });
        }

        // ページネーション（20件ずつ）
        $movies = $query->paginate(20);

        return view('getMovies', compact('movies'));
    }

    public function getAdminMovies()
    {
        $movies = Movie::all();
        return view('getAdminMovies', ['movies' => $movies]);
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function editMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return view('editMovie', ['movie' => $movie]);
    }

    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect('/admin/movies')
           ->with('success', '映画「'.$movie->title.'」を削除しました。');
    }

    public function storeMovie(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|unique:movies,title',  // ← ここを必ず入れる
            'image_url'      => 'required|url',
            'published_year' => 'required|integer|digits:4',
            'description'    => 'required|string',
            'is_showing'     => 'sometimes|boolean',
            'genre'          => 'required|string',
        ]);

        $data['is_showing'] = $request->has('is_showing');

        DB::transaction(function() use ($data) {
            $genre = Genre::firstOrCreate(['name' => $data['genre']]);
            Movie::create([
                'title'          => $data['title'],
                'image_url'      => $data['image_url'],
                'published_year' => $data['published_year'],
                'description'    => $data['description'],
                'is_showing'     => $data['is_showing'],
                'genre_id'       => $genre->id,
            ]);
        });

        return redirect()
            ->route('admin.movies.index')
            ->with('success', '映画を登録しました。');
    }

    /**
     * PUT /admin/movies/{id}/update
     * 映画を更新する
     */
    public function updateMovie(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $data = $request->validate([
            'title'          => 'required|string|unique:movies,title,'.$movie->id,
            'image_url'      => 'required|url',
            'published_year' => 'required|integer|digits:4',
            'description'    => 'required|string',
            'is_showing'     => 'sometimes|boolean',
            'genre'          => 'required|string',
        ]);
        $data['is_showing'] = $request->has('is_showing');

        DB::transaction(function() use ($movie, $data) {
            // ジャンルの取得 or 作成
            $genre = Genre::firstOrCreate(
                ['name' => $data['genre']],
                ['name' => $data['genre']]
            );
            // 映画更新
            $movie->update([
                'title'          => $data['title'],
                'image_url'      => $data['image_url'],
                'published_year' => $data['published_year'],
                'description'    => $data['description'],
                'is_showing'     => $data['is_showing'],
                'genre_id'       => $genre->id,
            ]);
        });

        return redirect()
            ->route('admin.movies.index')
            ->with('success', '映画を更新しました。');
    }

    public function show($id)
    {
        // 1) 作品情報
        $movie = Movie::findOrFail($id);

        // 2) スケジュールを取得（リレーションは使わずに直接 where）
        $schedules = Schedule::where('movie_id', $id)
                             ->orderBy('start_time')
                             ->get();

        return view('movies.show', compact('movie', 'schedules'));
    }

    public function showAdminMovie($id)
{
    // 映画を取得
    $movie = Movie::findOrFail($id);

    // 関連スケジュールを start_time 昇順で取得
    $schedules = Schedule::where('movie_id', $id)
                         ->orderBy('start_time')
                         ->get();

    // ビューに両方渡す
    return view('admin.movies.show', compact('movie', 'schedules'));
}



    


}