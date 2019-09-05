<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Tag::truncate();
    	
        factory(App\Tag::class, 20)->create();
    }
}
