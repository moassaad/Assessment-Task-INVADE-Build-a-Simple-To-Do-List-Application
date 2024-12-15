<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(! Auth::attempt($credentials))
        {
            return redirect()
                ->route('login')
                ->withErrors(['error'=>'Invalid email or password.'])
                ->withInput($credentials);
        }
        
        return redirect()->route('home');      
    }
}
