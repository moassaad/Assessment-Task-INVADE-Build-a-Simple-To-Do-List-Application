<?php

namespace App\Http\Controllers;


use ApiResource\App\API\APIResource;
use ApiResource\Examples\Laravel\APIResponse;
use ApiResource\Examples\Laravel\Exceptions\ErrorException;
use Illuminate\Http\Request;


class GeneralController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function test()
    {
        throw new ErrorException('email and password incorrect' );
        return APIResource::new()->successOk('success',['ok']);
    }
}
