<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AuthenController extends Controller
{
    //Registration
    public function registration()
    {
        return view('auth.registration');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email:users',
            'password'=>'required|min:8|max:12'
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        
        $result = $user->save();
        if($result){
            return back()->with('success','You have registered successfully.');
        } else {
            return back()->with('fail','Something wrong!');
        }
    }
    ////Login
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([            
            'email' => 'required|email:users',
            'password' => 'required|min:8|max:12'
        ]);
        
        $user = User::where('email', '=', $request->email)->first();
        
        // Check if the user exists
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful. Redirecting...',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Password does not match!',
                ], 401); 
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered.',
            ], 404); 
        }
    }
    
    //// Dashboard
    public function dashboard()
    {
        // return "Welcome to your dashabord.";
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('auth.dashboard',compact('data'));
    }
    ///Logout
    public function logout()
    {
        $data = array();
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('');
        }
    }
}
