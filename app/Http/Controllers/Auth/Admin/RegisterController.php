<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Division;
use App\Models\District;
use Illuminate\Support\Str;

use App\Notifications\VerifyRegistration;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @override
     * showRegistrationForm
     * Display the registration form
     * @return void view
     */
    public function showRegistrationForm()
    {
        $districts = District::orderBy('id','desc')->get();
        $divisions = Division::orderBy('priority','asc')->get();
        return view('auth.register', compact('districts','divisions'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'district_id' => ['required', 'numeric'],
            'division_id' => ['required', 'numeric'],
            'phone_no' => ['required', 'string','max:15'],
            'street_address' => ['required', 'string','max:100'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {   
        $token = Str::random(50);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Str::slug($request->first_name.$request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'district_id' => $request->district_id,
            'division_id' => $request->division_id,
            'phone_no' => $request->phone_no,
            'street_address' => $request->street_address,
            'ip_address' => $request->ip(),
            'remember_token' => $token,
            'status' => 0,
        ]);

        $user->notify( new VerifyRegistration( $user, $token));
        session()->flash('success', 'A confirmation email sent to your emmail. Please check and active your account');
        return redirect('/');
    }
}
