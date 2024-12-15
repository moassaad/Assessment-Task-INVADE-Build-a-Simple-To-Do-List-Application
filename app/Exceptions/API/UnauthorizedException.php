<?php

namespace App\Exceptions\API;


use App\Services\APIResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UnauthorizedException extends Exception
{
    public function report()
    {
        // put error in log file
    }
    public function render(Request $request):Response
    {
        return APIResponse::new()->errorUnauthorized($this->getMessage(), [$this->getTrace()]);
    }
}