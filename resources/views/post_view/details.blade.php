@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Details
                    @if( Auth::id()>0 )
                    &nbsp;<a class="btn btn-danger btn-xs" href="{{ route( 'admin.posts.edit', $post->id ) }}">Edit</a>
                    @endif
                </div>

                <div class="panel-body">   
                    <small>Writer: {{ $post->user->name }}, Updated At: {{ date('d-m-Y H:i', strtotime($post->updated_at)) }} </small>                 
                    <h4>{{ $post->title }}</h4>
                    <p>{{ $post->category->description }}</p>
                    <p>
                        Category: 
                        <a href="{{ route( 'guest.post.category', $post->category->id ) }}">{{ $post->category->title }}</a>
                    </p>
                    <p>
                    Tags: 
                    @foreach( $post->tags AS $kt=>$tag  )
                        <a href="{{ route( 'guest.post.tags', $tag->id ) }}" class="btn btn-info btn-xs">
                            {{ $tag->title }}
                        </a>
                    @endforeach                        
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
