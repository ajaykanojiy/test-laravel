<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index(request $request)
    { 
       

        $categorys = Category::latest()->paginate(5);
        return view('category.index',compact('categorys'))
           
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:png,jpg|max:2048',            
        ]);


        // 'name' => 'required',
        // 'username' => 'required|min:8',
        // 'email' => 'required|email|unique:users',
        // 'contact' => 'required|unique:users'
       
          
        $image= edit_image($request->image); 
 
        $request->image->move(public_path('uploads'), $image);

        // $id  =  Category::create(["image" => $image,"name" => $request->name]);

        $array = [
            "image" => $image,
            "name" => $request->name
          ];
       
       $res= Category::insertOrIgnore($array);

    
        return redirect()->route('category.index')
                        ->with('success','category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    { 
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $category=Category::find($id);
       
         return view('category.edit',compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'image|mimes:png,jpg|max:2048',
            
        ]);
        
        $category=Category::find($id);
   
       
        
        if ( $request->file('image')) {
          
            $image= edit_image($request->image);          

            $request->image->move(public_path('uploads'), $image);          
           
               $category->image=$image;
        }
        else{
            $category->image=$request->edit_image;
           }
           $category->name=$request->name;
            $res=$category->save();

            return redirect()->route('category.index')
            ->with('success','category Update successfully.');  
   
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $Category) 
    {
        $Category->delete();
        return redirect()->route('category.index')        
          ->with('success','category created successfully.');
    }
}
