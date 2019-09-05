<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bookmarks;
use Auth;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookmarks = Bookmarks::orderBy( 'id', 'desc' );
        if( $request->search!='' ){
            $bookmarks->where( 'title', 'like', "%{$request->search}%" );            
        }
        $bookmarks = $bookmarks->paginate( '10' );

        return view('bookmark.index', compact('bookmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'bookmark.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['description'] = trim($request['description']);
        if($request['description']=='<br>')
            $request['description'] ='';

        $url_unique_key = md5($request[ 'bookmark_url' ]);
        $request[ 'url_unique_key' ] = $url_unique_key;
                    
        $messages = [
            'url_unique_key.unique' => 'The bookmark URL is already exist.',
        ];

        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
            'bookmark_url' => 'required',
            'url_unique_key' => 'required|unique:bookmarks',
        ], $messages);
        

        $Bookmarks = new Bookmarks([
            'title' => $request['title'],
            'description' => htmlentities($request['description']),
            'status' => $request['status']
        ]);

        $Bookmarks->save();

        return redirect()->route('bookmark.index')
                        ->with('success','Created successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = Bookmarks::findOrFail($id);
        $route = 'bookmark.update';

        return view('bookmark.edit',compact('edit_data', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['description'] = trim($request['description']);
        if($request['description']=='<br>')
            $request['description'] ='';
        
        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
            'bookmark_url' => 'required',
        ]);

        $request['details'] = htmlentities($request['details']);        
        Bookmarks::findOrFail($id)->update($request->all());

        return redirect()->route('bookmark.index', $id)
                        ->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
