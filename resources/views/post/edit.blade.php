@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('post.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        @method('PUT')

         <div class="row">

         <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Approved by admin:</strong>
            <select class="form-control" name="approved_by_Admin" >
                <option value="0" <?php if($post->approved_by_Admin==0){ echo 'selected';} ?>>no</option>
                <option value="1" <?php if($post->approved_by_Admin==1){ echo 'selected';} ?>>yes</option>
            </select>
        </div>
    </div>

          
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
                <strong>Description:</strong>
		              <textarea name="description" class="form-control" placeholder="Description">{{$post->description}}</textarea>
		        </div>
		    </div>
		   
           
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                    <input type="hidden" name="edit_image" value="{{$post->Image}}">
                   {!!$errors->first('image', '<span class="text-danger">:message</span>')!!}
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection