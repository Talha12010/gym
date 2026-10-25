<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function index(){
        return redirect()->route('account.login');
   }





   public function authenticate(Request $request){

    $validator = Validator::make($request->all(), [

'email' => 'required|email',
'password' => 'required ',


    ]);

if($validator->passes()){
    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,])) {

        if(Auth::guard('admin')->user()->role != "admin"){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error','You are not authroised.');

        }

        return redirect()->route('admin.dashboard');
        // Authentication passed, handle successful login logic here
    } else {
        return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');
    }

}
else{
return     redirect()->route('admin.login')
-> withInput()
->witherrors($validator);
}


   }
   public function logout() {

    Auth::guard('admin')->logout();
    return redirect()->route('account.login');
 }
}


