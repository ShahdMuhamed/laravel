<?php

namespace App\Http\Controllers;
// use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    // show Register form
    public function create(){
        return view('users.register');
    }


    //add new user
    public function store(Request $request){

        $validatedData = $request-> validate([
            'name' => ['required' , 'min:3'],
            'email' => ['required' , 'email'],

            'password'=>'required|confirmed|min:6'
            // 'password'=>'min:2'

        ]);


        //hash password
//   dd($request->all(),$validatedData ,  $request->all()['password']);
         $validatedData['password'] = bcrypt($validatedData['password']);
         $user = User::create($validatedData); //for creation


         //login code
        //  session();
        //  Session::


         Auth::login($user);
         return redirect('/')-> with('message' , 'user created and logged in successfully');
    }


    //logout
    public function logout(Request $request){
        // auth()->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message' , 'user is logged out');
    }


    //show login form
    public function login(Request $request){
        return view('users.login');
    }

    //log in the user

    public function authenticate(Request $request){
        $data = $request->validate([
            'email'=> ['required' , 'email'],
            'password'=> 'required'
        ]);
        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect('/')->with('message' , 'you have logged in successfully');
        }
        return back()->withErrors(['email' => 'Invalid']);
    }

}

// -> m3 method gewa el class
//=> m3 array
