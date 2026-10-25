<?php

namespace App\Http\Controllers\trainer;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
   /* public function index(){
        return view('trainer.login');
   }*/

   public function register(   ){


    
    return view('trainer.register');
    
        
    }

    


    public  function processregister(Request $request){


    
        $validator = Validator::make($request->all(), [
    
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'name' => 'required',
            'password_confirmation' => 'required',
            
            
                    ]);
            
                if($validator->passes()){
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->role = 'trainer';
                    $user->save();
    
                    return     redirect()->route('account.login')-> with('success', 'Registration successful! Please login to continue.');
                    
            }
            else{
             return     redirect()->route('trainer.register')
            
             -> withInput()
             -> witherrors($validator);                
            }
     }
    /* public function authenticate(Request $request){

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required ',
            
            
                    ]);
            
                if($validator->passes()){
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $user = Auth::user();
                
                        if ($user->role === 'trainer') {
                            return redirect()->route('trainer.dashboard');
                        } elseif ($user->role === 'customer') {
                            return redirect()->route('account.login'); // Make sure this route exists
                        } elseif ($user->role === 'admin') {
                            return redirect()->route('admin.login'); // Make sure this route exists
                        } 
                        // Authentication passed, handle successful login logic here
                    } else {
                        
                        return redirect()->route('trainer.login')->with('error','Either email or password is incorrect.');
                    }
                    
            }
            else{
             return     redirect()->route('trainer.login')
             -> withInput()
             ->witherrors($validator);                
            }
        
*/        
          
           public function logout() {

            Auth::logout();
            return redirect()->route('account.login');
         }

}
 

    //

