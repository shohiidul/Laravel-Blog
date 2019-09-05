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
                <div class="panel-heading">Update Category</div>
                <div class="panel-body">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($edit_data, ['method' => 'PATCH','route' => [$route, $edit_data->id]]) !!}
                    
                    <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    {!! Form::textarea('description', html_entity_decode($edit_data->description), array('placeholder' => 'Details','class' => 'form-control','style'=>'height:100px', 'id'=>'summernote')) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status:</strong>
                                    {!! Form::select('status', array('1'=>'Active', '0'=>'Inactive') ,null, array('placeholder' => 'Select Status','class' => 'form-control')) !!}
                                </div>
                            </div>                            

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-danger" href="{{route( 'category.index' )}}">Cancel</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
