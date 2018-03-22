<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
class UserController extends Controller
{
    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        if( Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('/dashboard');
        } else {
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->intended('/login');
    }
}
