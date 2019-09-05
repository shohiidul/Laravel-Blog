<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy( 'id', 'desc' );
        if( $request->search!='' ){
            $categories->where( 'title', 'like', "%{$request->search}%" );            
        }
        $categories = $categories->paginate( '10' );

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'category.create' );
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

        $Category = new Category([
            'title' => $request['title'],
            'description' => htmlentities($request['description']),
            'status' => $request['status']
        ]);

        $Category->save();

        return redirect()->route('category.index')
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
        $edit_data = Category::findOrFail($id);
        $route = 'category.update';

        return view('category.edit',compact('edit_data', 'route'));
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
        Category::findOrFail($id)->update($request->all());

        return redirect()->route('category.index', $id)
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
