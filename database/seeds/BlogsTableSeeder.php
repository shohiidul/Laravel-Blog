<?php

use Illuminate\Database\Seeder;
use App\Post;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Post::truncate();

        factory(App\Post::class, 101)->create();

        $posts = Post::all();

        \DB::query( 'TRUNCATE TABLE  post_tag;' );

        foreach ( $posts as $key => $post ) {
            $post->tags()->attach( range(range(1, 10), range(11, 20)) );
        }
    }
}
