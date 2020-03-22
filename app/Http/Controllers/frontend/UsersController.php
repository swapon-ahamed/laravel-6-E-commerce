<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use App\Models\Division;
use App\Models\District;
use Illuminate\Support\Str;

class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
    	$user = Auth::user();
    	return view('frontend.pages.users.dashboard', compact('user'));
    }
    public function profile(){
    	$user = Auth::user();
    	$districts = District::orderBy('id','desc')->get();
    	$divisions = Division::orderBy('priority','asc')->get();
    	return view('frontend.pages.users.profile', compact('user','divisions','districts'));
    }

    public function profileUpdate( Request $request ){

    	$user = Auth::user();
    	$this->validate($request,[
    		'first_name' => ['required', 'string', 'max:50'],
    		'last_name' => ['required', 'string', 'max:30'],
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
    		'username' => ['required', 'alpha_dash', 'max:255', 'unique:users,username,'.$user->id],
    		// 'password' => ['required', 'string', 'min:8', 'confirmed'],
    		'district_id' => ['required', 'numeric'],
    		'division_id' => ['required', 'numeric'],
    		'phone_no' => ['required', 'string','max:15','unique:users,phone_no,'.$user->id],
    		'street_address' => ['required', 'string','max:100'],
    	]);

    	
    	$user->first_name 	= $request->first_name;
    	$user->last_name 	= $request->last_name;
    	$user->email 		= $request->email;
    	// $user->password = $request->password;
    	$user->district_id = $request->district_id;
    	$user->division_id = $request->division_id;
    	$user->phone_no 	= $request->phone_no;
    	$user->street_address = $request->street_address;
    	$user->shippint_address = $request->shippint_address;
    	$user->username  = $request->username;
    	$user->ip_address 	= request()->ip();

    	if($request->password !=null || $request->password !=''){
    		$user->password = Hash::make($request->password);
    	}

    	$user->save();

    	session()->flash('success', 'User profile has updated successfully');
    	return back();
    }
}
