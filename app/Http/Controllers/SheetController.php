<?php

namespace App\Http\Controllers;

use App\Models\Sheet;          // ← モデルを正しくインポート
use Illuminate\Http\Request;   // （不要なら削除して OK）

class SheetController extends Controller
{
    /**
     * GET /sheets
     */
    public function index()
    {
        // 列・行ごとのレイアウトを取得
        $columns = Sheet::distinct()->orderBy('column')->pluck('column')->toArray();
        $layout  = Sheet::orderBy('row')->orderBy('column')
                        ->get()
                        ->groupBy('row');

        return view('sheets.index', compact('columns', 'layout'));
    }
}
