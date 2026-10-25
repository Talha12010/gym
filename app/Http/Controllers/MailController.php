<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\mcgEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MailController extends Controller
{
// foregt password
   public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

    // send email


public function sendemail(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ]);

    $email = $request->input('email');
    $token = Str::random(60);

    // Store token
    DB::table('password_resets')->updateOrInsert(
        ['email' => $email],
        ['token' => $token, 'created_at' => now()]
    );

    $resetLink = url('/auth/update/' . $token);

    $subject = "Password Reset Link";
    Mail::to($email)->send(new mcgEmail($resetLink, $subject));

    return back()->with('success', 'Reset link sent successfully!');
}

// updateform
   public function updateshow($token)
{
    return view('auth.update', ['token' => $token]);
}

   // udatepassword
  public function forgot(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    $reset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->with('error', 'Invalid or expired reset token.');
    }

    DB::table('users')
        ->where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);

    // Delete token after use
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('account.login')->with('success', 'Password updated successfully!');
}


public function Showresetpassword()
{
    return view('auth.reset-password');
}

public function resetPassword(Request $request)
    {

        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'old_password' => 'required', // The old password field
            'password' => 'required|min:6|confirmed', // The new password and its confirmation
        ]);

        // Fetch the user by email
        $user = DB::table('users')->where('email', $request->input('email'))->first();

        // If user doesn't exist, return an error
        if (!$user) {
            return back()->with('error', 'Email not found in our records.');
        }

        // Verify the old password (compare with the stored password)
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }
else {
        // Update the user's password in the users table
        DB::table('users')
            ->where('email', $request->input('email'))
            ->update([
                'password' => Hash::make($request->input('password')),
            ]);

        return redirect()->route('account.login')->with('success', 'Password updated successfully!');}
    }

}

    //

