<?php

namespace App\Http\Controllers;


use App\Helpers\FileuploadHelpers;
use App\Models\User;
use App\Models\Applicant;
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
        
        if($formfields['is_company'] == false){
            $data['name'] = $formfields['name'];
            $data['email'] = $formfields['email'];
            $data['user_id'] = $user->id;
            Applicant::create($data);
        }

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
        $url = $request->getPathInfo();
        $id = explode("/", $url)[3];  
        // explode("/")
        $specificUser = User::find($id);
        if($specificUser){
            $formfields = $request->validate([
                'phone' => 'nullable|string',
                'establishment'=> 'nullable|string',
                'address' => 'nullable|string',
                'website' => 'nullable|string',
                'tradelicense' => 'nullable|string',
                'logo' => 'nullable|image'
            ]);
            if($request->tradelicensefile){
                $content = $request->file('tradelicensefile');
                $fileExtention  = $content->getClientOriginalExtension();
                $fileName = time()."_".rand(10000, 99999).'.'.$fileExtention;
                $temp = $request->file('tradelicensefile')->move(
                    base_path() . '/public/tradeLicenseFile', $fileName
                );
                $formfields['tradelicensefile'] = 'tradeLicenseFile/'.$temp->getFilename();
            }
            if($request->logo){
                $content = $request->file('logo');
                $fileExtention  = $content->getClientOriginalExtension();
                $fileName = time()."_".rand(10000, 99999).'.'.$fileExtention;
                $temp = $request->file('logo')->move(
                    base_path() . '/public/logo', $fileName
                );
                $formfields['logo'] = 'logo/'.$temp->getFilename();
            }
            User::where('id', $id)->update($formfields);
            return redirect('/company/profileSetup')->with('message', 'Profile Updated Successfully');
        }
        return redirect('/company/profileSetup')->with('message', 'User Not found!');
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
