<?php


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisternewController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mnumber' => 'required|string|min:8|max:11'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public  function create(Request $req)
      {    
        //   echo $req->lname;die;
             
        $image= edit_image($req->image); 
 
        $req->image->move(public_path('uploads'), $image);

         User::create([
            'name' => $req->name,
            'lname' => $req->lname,
            'mnumber' =>  $req->mnumber,
            'email' =>  $req->email,
            'image' => $image,
            'password' => Hash::make( $req->password,),
        ]);

      

        return redirect()->route('users.index')
        ->with('success','category created successfully.');
    }

    public function customLogin(Request $request)
    {  
      
      
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
            
        // $credentials = $request->only('email', 'password');
        // $credentials['approved_by_Admin']=1;
         
     
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'approved_by_Admin'=>4])) {
            echo 'ajay';die;
            // return redirect()->intended('layouts.app')
            //             ->withSuccess('Signed in');
            return view('layouts.app');
        }else{

             return redirect("login")->withSuccess('Login details are not valid');
        }
  
     
    }
}
