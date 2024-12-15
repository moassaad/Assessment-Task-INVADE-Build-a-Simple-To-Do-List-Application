<?php

namespace App\Exceptions\API;


use App\Services\APIResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class InternalServerErrorException extends Exception
{
    public function report()
    {
        // put error in log file
    }
    public function render(Request $request):Response
    {
        return APIResponse::new()->errorInternalServerError($this->getMessage(), [$this->errors()]);
    }
    private function errors()
    {
        return [
            'code'=>$this->getCode(),
            'message'=>$this->getMessage(),
            'line'=>$this->getLine(),
            'file'=>$this->getFile(),
        ];
    }
}