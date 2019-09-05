@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tags
                    <span class="pull-right">
                        <a class="btn btn-info btn-sm" href="{{ route('tag.create') }}">Add New</a>
                    </span>
                </div>

                <div class="panel-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form action="" method="GET" class="form-inline" role="form">
                    
                        <div class="form-group">
                            <label class="sr-only" for="">label</label>
                            {{Form::text( 'search', null, array( 'placeholder'=>'Search', 'class'=>'form-control', 'required'=>true ) )}}
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <br>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>S.L.</th>
                                <th>Title</th>
                                <th>Post</th>
                                <th>Status</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $tags AS $k => $tag )
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->posts->count() }}</td>
                                <td>{{ $tag->status=='1'?'Active':'Inactive' }}</td>
                                <td>
                                    <a href="{{ route( 'tag.edit', $tag->id ) }}">Edit</a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>
                        {{ $tags->appends(request()->input())->links() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
