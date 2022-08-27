<?php

namespace App\Http\Controllers;



use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class userControl extends Controller
{
    //show registration page
    public function create(){
       
        return view('users.register');
    }

    //store new user information
    public function store(Request $request){
        $formfields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],

        ]);

        //hash password
        $formfields['password'] =bcrypt($formfields['password']);
        
        //create the user in model
        $user = User::create($formfields);

        //redirect to login page
        auth()->login($user);

        return redirect('/')->with('message', 'User created successfully and logged in');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Success.');
    }

    public function login(Request $request){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formfields = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formfields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Authentication Success! Logged in!');
        }

        return back()->withErrors(["email"=>"Invalid Email", "password"=>"Invalid Password"]);
    }

}
