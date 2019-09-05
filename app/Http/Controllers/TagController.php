<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;

class TagController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::orderBy( 'id', 'desc' );
        if( $request->search!='' ){
            $tags->where( 'title', 'like', "%{$request->search}%" );            
        }
        $tags = $tags->paginate( '10' );

        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'tag.create' );
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
                    
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $Tag = new Tag([
            'title' => $request['title'],
            'description' => htmlentities($request['description']),
            'status' => $request['status']
        ]);

        $Tag->save();

        // $tag = \App\Tag::find( 1 );
        // $tag->posts()->sync([1001,1002,1003,990]);

        return redirect()->route('tag.index')
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
        $edit_data = Tag::findOrFail($id);
        $route = 'tag.update';

        return view('tag.edit',compact('edit_data', 'route'));
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
            'description' => 'required',
            'status' => 'required',
        ]);

        $request['description'] = htmlentities($request['description']);        
        Tag::findOrFail($id)->update($request->all());

        return redirect()->route('tag.index', $id)
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
