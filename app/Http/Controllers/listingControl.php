<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class listingControl extends Controller
{
    public function index(){
        //show all listing
        //we can get request through dependency injection
        //index(Request $request) then say dd($request)
        //or we can simply can use request helper methods
        //like say dd(request())
        //to view whats being sent with the request with query
        //to get a value dd(request()->'tagName') / dd(request('tagName'))

        return view('listings.index', [
            // 'listings' => Listings::all(), there is a cooler way to do it.
            //which ever return will happen will be sorted through latest first
            // 'listings' => Listings::latest()->filter(request(['tag','search']))->get()
            //this filter will automatically filter through tag name or search string and gets everything
            'listings' => Listings::latest()->filter(request(['tag','search']))->paginate('6')
            //this here adds a new thing paginate('numberToPaginate'). this will paginate the site depending
            //on given number and gets everything similiar to previous line above. or maybe simplePaginate()
        ]);
    }
    public function show(Listings $listing){
        //show single listing
        return view('listings.show',[
            'listing' => $listing,
        ]);
    }
    
    public function create(Listings $listing){
        //create form show
        return view('listings.create');
    }

    public function store(Request $request){
        //store listing data
        // dd(request()->all());

        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required', Rule::unique('listings', 'company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        $formFields['user_id'] = auth()->id();

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        Listings::create($formFields);
        return redirect('/listings/create')->with('message', 'success');

    }

    public function edit(Listings $listing){
        return view('listings.edit', ['listing'=>$listing]);
    }

    public function update(Request $request, Listings $listing){
        
        if(auth()->id() != $listing->user_id){
            abort(403, 'Unauthorized Access!');
        }

        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required', Rule::unique('listings', 'company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->create($formFields);

        return back()->with('message', 'success');
    }

    public function delete( Listings $listing){
        if(auth()->id() != $listing->user_id){
            abort(403, 'Unauthorized Access!');
        }
        $listing->delete();
        
        return back()->with('message', 'success');
    }
    
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
