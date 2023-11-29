<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class listingController extends Controller
{

// show all listings
public function index(){
    // dd(request('tag'));    //to get request
    return view('listings.index' , [
        'heading' => 'latest listings',
        // 'listings' => listing::all()      "get all the listing"
        'listings' =>
        listing::latest()->filter(request(['tag' , 'search']))->paginate(6)
        //get all listing sorted by the latests

        //lw 3ayze yzhr ka next we previous momkan astkhdm simplePaginate
    ]);
}



//show create form
public function create(){
    return view('listings.create');
}



//show one listing
public function show(listing $id){
    return view('listings.show' , [
        'listing' => $id
    ]);
}


// add to db
public function store(request $request){
    // dd($request->all());
    $formFields = $request-> validate(
        [
            'title' => 'required',
            'company' => ['required' , Rule::unique('listings' , 'company')],
            'location' => 'required',
            'website'=>'required',
            'email' => ['required' , 'email' , Rule::unique('listings' , 'email')],
            'tags'=>'required',
            'description'=>'required'
        ] //validations
        );
if($request-> hasFile('logo')){
    $formFields['logo'] = $request->file('logo')->store('logos' , 'public'); //store de ba7ut feha esm el folder
}

        listing::create($formFields);  // da line el add
        //"lazem aru7 el app service provider a3mel unguard"

        return redirect('/')-> with('message' , 'listing is created successfully');


}

//show edit form
public function edit(listing $listing){
    return view('listings.edit',['listing'=>$listing]);
}


//to update
public function update(request $request , listing $listing){
    // dd($request->all());
    $formFields = $request-> validate(
        [
            'title' => 'required',
            'company' => ['required' ],
            'location' => 'required',
            'website'=>'required',
            'email' => ['required' , 'email' ],
            'tags'=>'required',
            'description'=>'required'
        ] //validations
        );
if($request-> hasFile('logo')){
    $formFields['logo'] = $request->file('logo')->store('logos' , 'public'); //store de ba7ut feha esm el folder
}

        $listing->update($formFields);  // da line el add
        //"lazem aru7 el app service provider a3mel unguard"

        return back()-> with('message' , 'listing is updated successfully');


}


//to delete
public function destroy(listing $listing){
    $listing->delete();
   return redirect('/')->with('message' , 'listing is deleted successfully');

}
}
