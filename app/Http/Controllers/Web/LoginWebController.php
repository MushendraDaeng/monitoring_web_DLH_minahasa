<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginWebController extends Controller
{
    //

    public function viewLogin(){
        if(Auth::user()){
            return Redirect::to(url()->previous());
        }
        return view('login');
    }

    public function loginValidation(Request $request){
        // dd($request);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard')
                            ->withSuccess('Login Successful');

        }
        return redirect("login")->with('deleted', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}
