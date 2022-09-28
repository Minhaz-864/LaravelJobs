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
        //dd($request);
        $formfields = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:8'],
            
        ]);

        if($request->company_check){
            $formfields['is_company'] = true;
        }else {
            $formfields['is_company'] = false;
        }

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

    public function profile(){
        return view('users.profile', ['profile'=>auth()->user()]);
    }

    public function changePassword(){
        return view('users.changepassword');
    }

    public function update(Request $request){
        $url = $request->getPathInfo(); // ['','user' ,'profile' ,'2'][3]
        $id = explode("/", $url)[3];  
        // explode("/")
        $specificUser = User::find($id);
        if($specificUser){
            dd($request->all()); //start working from here
            
        }
        return response("User not found, please try loggin in", 404);
    }

    public function updatePassword(Request $request){
        $url = $request->getPathInfo();
        $id = explode("/", $url)[2];  
        $specificUser = User::find($id);
        
        $formfields = $request->validate([
            'email' => ['required','email'],
            'password' => ['required', 'confirmed', 'min:8'],
            
        ]);
        //hash password
        $formfields['password'] =bcrypt($formfields['password']);
        
        $user = User::where('id', $id)
            ->update($formfields);
        // //create the user in model
        // $user = User::create($formfields);
        

        return redirect('/company/profileSetup')->with('message', 'Password Updated Successfully');
    }

}
