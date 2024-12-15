<?php

namespace App\Exceptions\API;


use App\Services\APIResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ErrorException extends Exception implements ErrorInterfaceException
{
    private array $errors;
    public function __construct(string $message = "", int $code = 500, array $errors = [])
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }
    public function report()
    {
        // put error in log file
    }
    public function render(Request $request):Response
    {
        return APIResponse::new()->error($this->code, $this->getMessage(), [$request]);
    }
}