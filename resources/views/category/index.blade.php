@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New categorys</a>
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
            <th>Name</th>
            <!-- <th>Description</th> -->
            <th>Image</th>
            <th>Date</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($categorys as $category)
	    <tr>
	        <td>{{ ++$i }}</td>
	     
	        <td>{{ $category->name }}</td>
	      
	        <!-- <td><img src="{{ asset('uploads/'.$category->Image) }}" height="50px"></td> -->
	        <td><img src="{{ productImagePath($category->Image) }}" height="50px"></td>
	        <td>{{ $category->created_at}}</td>
	        <td>
                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('category.show',$category->id) }}">Show</a>
                    @can('category-edit')
                    <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('category-delete')
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $categorys->links() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection