<?php

namespace Database\Seeders;

use App\Models\Practice;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Practice::factory(10)->create();
        Movie::factory(10)->create(); // Assuming you have a Movie factory
        // ここでシートマスタを登録
        $this->call([
            SheetSeeder::class,
        ]);
    }
}
