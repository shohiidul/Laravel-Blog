@extends('layouts.app')

@section('style')
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection

@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote({
    placeholder: 'Description',
    tabsize: 2,
    height: 100
  });
});    
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Bookmark</div>
                <div class="panel-body">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'bookmark.store','method'=>'POST')) !!}
                    
                    <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Short desc.:</strong>
                                    {!! Form::textarea('short_desc', null, array('placeholder' => 'Details','class' => 'form-control','style'=>'height:100px', 'id'=>'')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Details:</strong>
                                    {!! Form::textarea('details', null, array('placeholder' => 'Details','class' => 'form-control','style'=>'height:100px', 'id'=>'summernote')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Url:</strong>
                                    {!! Form::text('bookmark_url', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                </div>
                            </div>                           

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-danger" href="{{route( 'bookmark.index' )}}">Cancel</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
