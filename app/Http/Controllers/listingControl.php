<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class listingControl extends Controller
{
    public function index(){

        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag','search']))->paginate('6')
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
        return view('listings.create', ['profile'=>auth()->user()]);
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
        $formFields['logo'] = auth()->user()->logo;
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
        return view('listings.manage', ['listings' => auth()->user()->listings()->latest()->paginate('6')]);
    }

    public function apply_manage(){
        return view('applicant.manage', ['listings' => auth()->user()->appliedjobs()->latest()->paginate('6')]);
    }
    public function applicantSetup(){
        // dd(auth()->user()->applications()->get());
        return view('applicant.setup', ['profile' => auth()->user()->applications()->get()]);
    }
    
    
}
