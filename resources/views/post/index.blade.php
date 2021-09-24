@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Posts</h2>
            </div>
            <div class="pull-right">
                @can('post-create')
                <a class="btn btn-success" href="{{ route('post.create') }}"> Create New Post</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <!-- <th>Category </th> -->
            <!-- <th>Name</th> -->
            <th>Description</th>
            <th>Image</th>
            <!-- <th>Date</th> -->
            <th width="280px">Action</th>
        </tr>
	    @foreach ($posts as $post)
	    <tr>
	        <td>{{ ++$i }}</td>
	     
	        <td>{{ $post->description }}</td>
	      
	        <!-- <td><img src="{{ asset('uploads/'.$post->Image) }}" height="50px"></td> -->
	        <td><img src="{{ productImagePath($post->Image) }}" height="50px"></td>
	        <!-- <td>{{ $post->created_at}}</td> -->
	        <td>
                <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('post.show',$post->id) }}">Show</a>
                    @can('post-edit')
                    <a class="btn btn-primary" href="{{ route('post.edit',$post->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('post-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $posts->links() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection