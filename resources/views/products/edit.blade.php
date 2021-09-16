@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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


    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        @method('PUT')


         <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
		      

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Description:</strong>
		            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{$product->description}}</textarea>
		        </div>
		    </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
		            <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Price">
		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Stock:</strong>
                    <input type="hidden" name="stock_id" value="{{$product->stock->id}}">
		            <input type="text" name="stock" class="form-control" value="{{$product->stock->stock}}" placeholder="Stock">
		        </div>
		    </div>
           
           <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                    <input type="hidden" name="edit_image" value="{{$product->Image}}">
                    <img src="{{ productImagePath($product->Image) }}" height="50px">
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