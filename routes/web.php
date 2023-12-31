<?php

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [listingController::class, 'index'] );
    // return view('listings' , [
    //     'heading' => 'latest listings',
    //     'listings' => listing::all()
    // ]);



// for only one listing

Route::get('/oneList/{id}' , [listingController::class, 'show'] );
    // return view('listing' , [
    //     'listing' => $id

    // ]);

// 'listing' => listing::find($id)


//to show create form
Route::get('/listings/create' , [listingController::class, 'create'])->middleware('auth');

Route::post('/listings' , [listingController::class, 'store'] )->middleware('auth');


//to show edit form
Route::get('/listings/{listing}/edit' , [listingController::class, 'edit'] )->middleware('auth');


//to update
Route::put('/listings/{listing}' , [listingController::class, 'update'])->middleware('auth');


//to delete
Route::delete('/listings/{listing}' , [listingController::class, 'destroy'])->middleware('auth');


//to register form user
Route::get('/register' , [UserController::class, 'create'])->middleware('guest');

//create user
Route::post('/users' , [UserController::class, 'store'] );


//log out user
Route::post('/logout' , [UserController::class, 'logout']);

//show login form
Route::get('/login' , [UserController::class , 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate' , [UserController::class , 'authenticate']);


//manage listings
Route::get('/listings/manage' , [listingController::class , 'manage'])->middleware('auth');




// Route::get('/hello' , function(){
//     return response('<h1>hello world</h1>',200)
//     ->header('Content-Type' , 'text/plain')
//     ->header('hey' , 'nooo');
// });

// Route::get('/posts/{id}', function($id){
//     ddd($id);
//     return response('post ' . $id);
// }) ->where('id' , '[0-9]+');


// Route::get('/search' , function(Request $request){
//     return $request->name . ' ' . $request->age;

// });
