<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = './admin';
    //
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    /**
     * login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        if(Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            return redirect()->intended('/admin/post');
        }
        return back()->withErrors([
            'email' => '邮箱不存在'
        ]);
    }
}
