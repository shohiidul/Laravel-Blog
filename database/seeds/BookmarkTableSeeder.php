<?php

use Illuminate\Database\Seeder;
use App\Bookmarks;

class BookmarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Bookmarks::truncate();

        factory(Bookmarks::class, 35)->create();
    }
}
