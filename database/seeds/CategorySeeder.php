<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Category::truncate();

        factory(App\Category::class, 10)->create();
    }
}
