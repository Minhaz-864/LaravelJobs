<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Applicant;


class applicantControl extends Controller
{
    //
    public function applicantSetup(Request $request){

        $url = $request->getPathInfo();
        $id = explode("/", $url)[3]; 
        $formfields = $request->validate([
            'name' => 'string| required',
            'email' => 'email|required',
            'phone' => 'nullable | string',
            'gender'=> 'nullable | string',
            'dob' => 'nullable | string',
            'latest_degree' => 'nullable | string', 
            'latest_institute' => 'nullable |string',
            'present_address' => 'nullable | string',
            'cover_letter' => 'nullable | string',
        ]);
        if($request->hasFile('cv')){

            $content = $request->file('cv');
            $fileExtention  = $content->getClientOriginalExtension();
            $fileName = time()."_".rand(10000, 99999).'.'.$fileExtention;
            $temp = $request->file('cv')->move(
                base_path() . '/public/cv', $fileName
            );
            $formfields['cv'] = 'cv/'.$temp->getFilename();
        }
        $updateable = Applicant::where('user_id', $id)->update($formfields);

        return redirect('/applicant/profileSetup')->with('message', 'Profile Updated Successfully');
    }
}
