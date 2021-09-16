<!DOCTYPE html>
<html>
<head>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>

    
<div class="container mt-5">
  
    <table class="table table-bordered yajra-datatable" >
        <thead>
            <tr>
                <!-- <th>No</th> -->
                <th>Name</th>
                <th>description</th>
                <th>price</th>
                <th>Image</th>
                <th>Stock</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
   
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
      
        ajax: "{{ url('list') }}",
        columns: [
            
            { "data": "name" },
            { "data": "description" },
            { "data": "price" },
            

            {"data": "Image",
               "render": function (data,type,full,meta) {
                             
                    
                    // return "<img src={{URL::to('/')}}/uploads/"+data + "width='50'/>";
                    return '<img src="{{asset('uploads/')}}/'+data + '" width="50px" >';
                    // asset('uploads/'.$image_name)
                         },
                         orderable:false  
                        },


            { "data": "stock.stock" },
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'name', name: 'name'},
            // {data: 'description', description: 'description'},
            // {data: 'price', price: 'price'},
            // {data: 'Image', Image: 'Image'},
            // {data: 'Stock', stock: 'stock'},
            // {"id":1,"product_id":5,"stock":20,"created_at":null,"updated_at":null},
             
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>
</html>