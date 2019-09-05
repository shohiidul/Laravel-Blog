<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(BlogsTableSeeder::class); // this is for post table
        $this->call(BookmarkTableSeeder::class); 
    }
}
