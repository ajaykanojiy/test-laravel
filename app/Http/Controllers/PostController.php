<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('post.index',compact('posts'))
           
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
            'description' => 'required|unique:posts',
            'image' => 'required|image|mimes:png,jpg|max:2048',            
        ]);

          
        $image= edit_image($request->image); 
 
        $request->image->move(public_path('uploads'), $image);

        // $id  =  Post::create(["image" => $image,"description" => $request->description]);

        $array = [
            "image" => $image,
            "description" => $request->description,
           
          ];
       
       $res= Post::insertOrIgnore($array);

    
        return redirect()->route('post.index')
                        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
       
         return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'description' => 'required|unique:posts',
            'image' => 'image|mimes:png,jpg|max:2048',
            
        ]);
        
        $post=Post::find($id);
   
       
        
        if ( $request->file('image')) {
          
            $image= edit_image($request->image);          

            $request->image->move(public_path('uploads'), $image);          
           
               $post->image=$image;
        }
        else{
            $post->image=$request->edit_image;
           }
           $post->description=$request->description;

           $post->approved_by_Admin=$request->approved_by_Admin;
            $res=$post->save();

            return redirect()->route('post.index')
            ->with('success','Post Update successfully.');  
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')        
          ->with('success','Post created successfully.');
    }
}
