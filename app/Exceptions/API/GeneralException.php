<?php

namespace App\Exceptions\API;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GeneralException extends Exception
{
    public function report()
    {

    }
    public function render(Request $request):Response
    {
        return response($this->getMessage());
    }
}
