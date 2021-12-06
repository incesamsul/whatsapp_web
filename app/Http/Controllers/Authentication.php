<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function login()
    {
        return view('authentication.login_biasa');
    }

    public function wrapperLogin()
    {
        return view('authentication.wrapper_login');
    }

    public function qrLogin()
    {
        return view('authentication.login_qrcode');
    }

    public function scanQrcode()
    {
        return view('kasir.qrcode_login');
    }

    public function postLogin(Request $request)
    {
        $user = User::where('username', $request->username)
            ->first();


        if ($user) {
            if (password_verify($request->password, $user->password)) {
                Auth::login($user);
                return redirect('/main');
            } else {
                return redirect('/login-biasa')->with('fail', 'Password yang anda masukan salah');
            }
        } else {
            return redirect('/login-biasa')->with('fail', 'Username yang anda masukan salah');
        }
        // if (Auth::attempt($request->only('username', 'password'))) {
        //     return redirect('/kasir');
        // }
        // return redirect('/login-biasa')->with('fail', 'Username atau password anda salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
