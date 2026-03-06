<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Gate,
    Hash
};


class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $userData = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
        $rememberMe = ($request->get('remember_me')) ? true : false;
        
        if (Auth::attempt($userData, $rememberMe)) {
            if (Auth::user()->hasRole('AdminProcessing')) {
                return redirect('/processing/processingdashboard')->with('success', 'Login Successful');
            } else if (Auth::user()->hasRole('UserRequesting')) {
                return redirect('/requesting/requestingdashboard')->with('success', 'Login Successful');
            } else if (Auth::user()->hasRole('UserApproval')) {
                return redirect('/approval/approvaldashboard')->with('success', 'Login Successful');
            } else {
                return back()->with('error', 'You do not have permission to access this page');
            }
        }
        return back()->with('error', 'Username or Password Incorrect');
    }
    
    public function logout() {   
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgotpassword()
    {
        return view('forgot'); // Assuming you have a 'forgot.blade.php' view.
    }

    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Please check your email and reset your password.");
        } 
        else 
        {
            return redirect()->back()->with('error', "Email not found in the system.");
        }
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view( 'auth.reset', $data);
        }
        else {
            abort(404);
        }
    }

    public function Postreset ($remember_token, Request $request)
    {
        if($request->newpassword == $request->cpassword)
        {
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->newpassword);
            $user->remember_token =Str::random(30);
            $user->save();

            return redirect()->route('login')->with('success', "Password Successfully Reset.");
        }
        else {
            return redirect()->back()->with('error', "Password and Confirm Password does not match.");
        }
    }

}
