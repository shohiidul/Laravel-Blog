@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{$title}}</div>

                <div class="panel-body">                    
                    @if( isset( $posts ) && count($posts)>0 )
                        @foreach( $posts AS $k=>$post  )
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>
                                            <a href="{{route( 'guest.post.details', $post->name )}}">
                                                {{ $post->title }}
                                            </a>
                                        </h5>
                                        <small>
                                            Writer: 
                                            <a href="{{ route( 'guest.post.author', $post->user->id ) }}">{{ $post->user->name }}</a>, Updated At: {{ date('d-m-Y H:i', strtotime($post->updated_at)) }} 
                                        </small>
                                        <div class="col-md-12">
                                            Category:
                                            <a href="{{ route( 'guest.post.category', $post->category->id ) }}">{{ $post->category->title }}</a>
                                        </div>
                                        <div class="col-md-12">
                                            Tags: 
                                            @foreach( $post->tags AS $kt=>$tag  )
                                                <a href="{{ route( 'guest.post.tags', $tag->id ) }}" class="btn btn-info btn-xs">
                                                    {{ $tag->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <p>{{ $posts->links() }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Category</div>

                <div class="panel-body">
                    @if(isset($all_categories) && count($all_categories)>0)
                        @foreach( $all_categories AS $k1 => $val )
                            <a href="{{ route( 'guest.post.category', $val->id ) }}">{{$val->title}}</a> <br>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>

                <div class="panel-body">
                    @if(isset($all_tags) && count($all_tags)>0)
                        @foreach( $all_tags AS $k1 => $val )
                            <a href="{{ route( 'guest.post.tags', $val->id ) }}">{{$val->title}}</a> <br>
                        @endforeach
                    @endif
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection
