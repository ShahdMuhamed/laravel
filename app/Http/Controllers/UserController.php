<?php

namespace App\Http\Controllers;
// use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            
            // 'password'=>'required|confirmed|min:6'
            // 'password'=>'min:2'

        ]);


        //hash password
  dd($request->all(),$validatedData ,  $request->all()['password']);
         $validatedData['password'] = bcrypt($validatedData['password']);
         $user = User::create($validatedData); //for creation


         //login code
        //  session();
        //  Session::

         auth()->login($user);
         Auth::login($user);
         return redirect('/')-> with('message' , 'user created and logged in successfully');
    }
}

// -> m3 method gewa el class
//=> m3 array
