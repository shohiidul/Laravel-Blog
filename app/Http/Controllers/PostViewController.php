<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;

class PostViewController extends Controller
{
    
	public function home( Request $request )
	{
        $posts = Post::with( 'category','tags', 'user' )->orderBy( 'id', 'desc' );
        if( $request->search!='' ){
            $posts->where( 'title', 'like', "%{$request->search}%" );            
        }
        $posts = $posts->paginate( '10' );		

        $title = 'Posts';

        $all_categories = Category::all();
        $all_tags       = Category::all();

		return view( 'post_view.index', compact( 'posts', 'title', 'all_categories', 'all_tags' ) );
	}

	public function details( Request $request )
	{
		$post = Post::with( 'category','tags', 'user' )->where( 'name', '=', $request->name  )->first();

		if(empty($post))
			abort( 404, 'The page you are looking for does not exist.' );	


		return view( 'post_view.details', compact( 'post' ) );
	}

    public function category_post( Request $request )
    {
        $posts = Post::with( 'category','tags', 'user' )->whereHas( 'category', function($query) use($request){
            $query->where( 'id', '=', $request->category );
        })->orderBy( 'id', 'desc' );

        if( $request->search!='' ){
            $posts->where( 'title', 'like', "%{$request->search}%" );            
        }
        $posts = $posts->paginate( '10' );  

        $title = 'Posts By Categories';

        $all_categories = Category::all();
        $all_tags       = Category::all(); 
        
        return view( 'post_view.index', compact( 'posts', 'title', 'all_categories', 'all_tags' ) );
    }

	public function tags_post( Request $request )
	{        
        $posts = Post::with( 'category','tags', 'user' )->whereHas('tags', function($query) use($request){
        	$query->where( 'id', '=', $request->tag );
        })->orderBy( 'id', 'desc' );

        if( $request->search!='' ){
            $posts->where( 'title', 'like', "%{$request->search}%" );            
        }

        $posts = $posts->paginate( '10' );	

        $title = 'Posts By Tags';

        $all_categories = Category::all();
        $all_tags       = Category::all();		

		return view( 'post_view.index', compact( 'posts', 'title', 'all_categories', 'all_tags' ) );
	}

    public function author_post( Request $request )
    {
        $posts = Post::with( 'category','tags', 'user' )->whereHas( 'user', function($query) use($request){
            $query->where( 'id', '=', $request->author_id );
        })->orderBy( 'id', 'desc' );
        

        if( $request->search!='' ){
            $posts->where( 'title', 'like', "%{$request->search}%" );            
        }
        $posts = $posts->paginate( '10' );  

        $title = 'Posts By Author'; 

        $all_categories = Category::all();
        $all_tags       = Category::all();
        
        return view( 'post_view.index', compact( 'posts', 'title', 'all_categories', 'all_tags' ) );
    }

}
