<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listings;
use App\Models\User;
use App\Models\Applications;
class ApplyControl extends Controller
{
    //
    public function index(Request $request)
    {
        $url = $request->getPathInfo();
        $listingId = explode('/', $url)[2];
        $listing = Listings::find($listingId);
        $user = auth()->user()->applications()->get();
        $company = User::find($listing->user_id);

        return view('applicant.apply', ['listing'=>$listing, 'profile'=>$user, 'company'=>$company]);
    }
    public function store(Request $request)
    {
        $formfields = $request->validate([
            "company" => "string",
            "comapny_id" => "string",
            "title" => "string",
            'listing_id'=>'string',
            "tags" => "string",
            "website" => "string",
            "applicant_id" => "string",
            "cover_letter" => "string",
        ]);
        $formfields['user_id'] = auth()->user()->id;
        
        $check_if_applied = Applications::where([
            ["listing_id", "=", $formfields['listing_id']],
            ["applicant_id", "=", $formfields['applicant_id']]
        ]);
        
        if (!$check_if_applied->first()) { 

            $apply = Applications::create($formfields);

            return back()->with('message', 'Application Successful');
        }
        
        return back()->with('message', 'Already applied for this job');
    }

    public function delete(Applications $application){
        if(auth()->id() != $application->user_id){
            abort(403, 'Unauthorized Access!');
        }
        $application->delete();

        return back()->with('message', 'success');
    }

    public function manageApplications(Request $request){
        $applicationsbyuser = Applications::where([
            ['comapny_id','=', auth()->user()->id],
            ['status', '!=', 'Rejected']
            ])->paginate('6');
        
        return view('users.manageApplications', ["listings"=>$applicationsbyuser]);
    }

    public function accept(Request $request){
        $id = explode('/', $request->getPathInfo())[3];
        $listing_id = $request->listing_id;
        Applications::where([
            ['applicant_id',"=", $id],
            ['listing_id', "=", $listing_id]
            ])->update(['status'=>'Accepted']);
        return redirect('/company/applications')->with('message', 'Application Updated');
    }
    public function reject(Request $request){
        $id = explode('/', $request->getPathInfo())[3];
        $listing_id = $request->listing_id;
        Applications::where([
            ['applicant_id',"=", $id],
            ['listing_id', "=", $listing_id]
            ])->update(['status'=>'Rejected']);
        return redirect('/company/applications')->with('message', 'Application Updated');
    }
}
