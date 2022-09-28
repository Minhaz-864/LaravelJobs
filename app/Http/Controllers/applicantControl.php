<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class applicantControl extends Controller
{
    //
    public function applicantSetup(Request $request){
        dd($request->all());
    }
}
