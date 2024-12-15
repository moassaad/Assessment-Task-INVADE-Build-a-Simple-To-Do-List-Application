<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LoginTrait {
    private function login() : void
    {
        Auth::attempt(['email'=>'max@mail.com','password'=>'password']);
        Auth::login(Auth::user());
    }
}