<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index(){
return view('login');

    }
    public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->route('account.login')
            ->withInput()
            ->withErrors($validator);
    }

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    // Try the default guard first (same users table covers all roles)
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Admins authenticate here too, but need the admin guard session
        if ($user->role === 'admin') {
            Auth::logout();
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.dashboard');
        }

        // Check if the user is approved
        if ($user->status !== 'approved') {
            Auth::logout();
            return redirect()->route('account.login')->with('error', 'Your account is pending approval by the admin.');
        }

        // Check the role and redirect accordingly
        if ($user->role === 'trainer') {
            return redirect()->route('trainer.dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('account.dashboard');
        }

        Auth::logout();
        return redirect()->route('account.login')->with('error', 'Unauthorized access.');
    }

    // Fallback: establish the session via the admin guard
    if (Auth::guard('admin')->attempt($credentials)) {
        $admin = Auth::guard('admin')->user();

        if ($admin->role !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('account.login')->with('error', 'Unauthorized access.');
        }

        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
}

public function register(   ){



return view('register');


}
 public function processregister(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
        'name' => 'required',
        'password_confirmation' => 'required',
    ]);

    if ($validator->passes()) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'customer';
        $user->status = 'pending'; // Add this line to set user as pending
        $user->save();

        return redirect()->route('account.login')->with('success', 'Registration successful! Please wait for admin approval.');
    } else {
        return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
    }
}


 public function logout() {

    Auth::logout();
    return redirect()->route('account.login');
 }

}
