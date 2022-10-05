<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminControl extends Controller
{
    //
    public function index(){
        return view('admin_manage', 
        ['users' => User::where([
            ['is_company', '=', '1'],
            ['review', '=', 'Pending']
        ])->paginate('6'), 'page'=>'pending']);
    }

    public function update(Request $request){
        
        $explodedUrl = explode("/", $request->getPathInfo());
        $status = $explodedUrl[2];
        $id = $explodedUrl[3];

        if($status == 'accept'){
            
            $update = User::where('id', $id)->update(['review'=> 'Accepted']);
        }
        else if($status == 'reject'){
            $update = User::where('id', $id)->update(['review'=> 'Rejected']);
        }
        
        return back()->with('message', 'Updated Successfully');

    }

    public function rejected(){
        $data = User::where([
            ['is_company', '=', '1'],
            ['review', '=', 'Rejected']
        ])->paginate('6');
        return view('admin_manage', ['users'=>$data, 'page'=>'rejected']);
    }

    public function accepted(){
        $data = User::where([
            ['is_company', '=', '1'],
            ['review', '=', 'Accepted']
        ])->paginate('6');
        return view('admin_manage', ['users'=>$data, 'page'=>'accepted']);
    }
}
