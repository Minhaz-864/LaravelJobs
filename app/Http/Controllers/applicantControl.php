<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class applicantControl extends Controller
{
    //
    public function applicantSetup(Request $request){
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
        // if($request->hasFile('cv')){
        //     $path = 'CV';
        //     $formfields['cv'] = FileuploadHelpers::fileStore($request->cv, $path);
        // }
        dd($formfields);
    }
}
