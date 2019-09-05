<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Post;
use App\Category;
use App\Tag;
use Auth;

class PostsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $posts = Post::orderBy( 'id', 'desc' );
        if( $request->search!='' ){
            $posts->where( 'title', 'like', "%{$request->search}%" );            
        }
        $posts = $posts->paginate( '10' );

        return view('posts.index', compact('posts'));
    }
    // admin.posts.create
    public function create()
    {
        $categories = Category::pluck( 'title', 'id' );
        $tags       = Tag::pluck( 'title', 'id' );

        return view( 'posts.create', compact('categories', 'tags') );
    }
    // admin.posts.store
    public function store(Request $request)
    {
        $request['description'] = trim($request['description']);
        if($request['description']=='<br>')
            $request['description'] ='';
                    
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);

        $request['created_by'] = Auth::id();

        // $slug = SlugService::createSlug(Post::class, 'name', 'My First Post', ['unique' => true]);

        $post = new Post([
            'title' => $request['title'],
            'description' => htmlentities($request['description']),
            'status' => $request['status'],
            'created_by' => $request['created_by'],
            'category_id' => $request['category_id'],
        ]);

        $post->save();

        // $post = Post::find( 1001 );
        $post->tags()->attach($request['tags']); // create new
        // $post->tags()->detach([1, 654, 987]); // delete
        // $post->tags()->sync([2, 3, 15, 20]);

        return redirect()->route('admin.posts')
                        ->with('success','Created successfully');       
    }
    // admin.posts.edit
    public function edit($id)
    {
        $edit_data  = Post::findOrFail($id);
        $categories = Category::pluck( 'title', 'id' );
        $tags       = Tag::pluck( 'title', 'id' );
        $route      = 'admin.posts.update';

        return view('posts.edit',compact('edit_data', 'route', 'categories', 'tags'));
    }
    // admin.posts.update
    public function update(Request $request, $id)
    {
        $request['description'] = trim($request['description']);
        if($request['description']=='<br>')
            $request['description'] ='';
        
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);

        $request['description'] = htmlentities($request['description']);        
        $post = Post::findOrFail($id);

        $post->update($request->all());

        $post->tags()->detach();
        if( $request['tags']!='' )
            $post->tags()->sync($request['tags']);
        
        return redirect()->route('admin.posts', $id)
                        ->with('success','Updated successfully');
    }


}
