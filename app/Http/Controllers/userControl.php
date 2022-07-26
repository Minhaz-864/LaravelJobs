<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userControl extends Controller
{
    //
    public function create(){
        return view('register');
    }
}
