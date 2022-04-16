<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'email' => 'required',
        ]);
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password], $remember = true))
        {
            $ck_user = User::find(Auth::user()->id);
            if (isset($ck_user) && $ck_user -> role == 1){
                return redirect('/admin');
            }
            elseif (isset($ck_user) && $ck_user -> role == 0){
                return redirect('/');
            }
            Auth::logout();
            return redirect('/login');
        }
        return redirect('/login');
    }
}

