
<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


  if (!function_exists('test')){
       function test(){
           $user= Auth::user();
          return $user->email;
       }
  }

  if (!function_exists('productImagePath')){
   function productImagePath($image_name)
   {
    
    return   asset('uploads/'.$image_name);
  }
  }


  if (!function_exists('edit_image')){
    function edit_image($image)
    {
      $image =  time().'.'.$image->extension();      
      return $image;  
    }
   }

   if (!function_exists('p')){
    function p($p)
    {
     echo '<pre>';print_r($p);'</pre>'; 
    }
   }
 



//   if (!function_exists('myCustomHelper')) {
//     function myCustomHelper() {
//         // logic here
//     }
// }
