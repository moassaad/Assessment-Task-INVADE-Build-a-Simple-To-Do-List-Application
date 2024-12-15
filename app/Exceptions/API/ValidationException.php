<?php

namespace App\Exceptions\API;


use App\Services\APIResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ValidationException extends Exception
{
    private $status = 422;
    public function report()
    {
        // put error in log file
    }
    public function render(Request $request):Response
    {
        return APIResponse::new()->error($this->status, $this->getMessage(), [$this->errors()]);
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