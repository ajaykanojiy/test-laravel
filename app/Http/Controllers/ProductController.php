<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Event;
use App\Events\SendMail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        // $this->events->fire(new SendMail('ajaykantkanojiya@gmail.com'));
       

        $products = Product::with('category')->latest()->paginate(5);
         
        // p($products);die;
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys=Category::all();
        return view('products.create',compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'image' => 'required|image|mimes:png,jpg|max:2048',            
        ]);
        
        $image= edit_image($request->image); 
 
        $request->image->move(public_path('uploads'), $image);

        $id  =  Product::create(["image" => $image,"name" => $request->name,"category_id" => $request->category_id,"description" => $request->description]);
        //   p($id);die;
            if($id){    
           event(new SendMail('ajaykantkanojiya@gmail.com',$id));
              }
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {  
        
        $categorys=Category::all();
       
        return view('products.edit',compact('product','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
           
        ]);
          
        $product->category_id=$request->category_id;
        $product->name=$request->name;
        $product->description=$request->description;

        if ( $request->file('image')) {
          
            $image= edit_image($request->image);          

            $request->image->move(public_path('uploads'), $image);          
           
               $product->image=$image;
        }
        else{
            $product->image=$request->edit_image;
           }
          
         $res=$product->save();

        // $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
