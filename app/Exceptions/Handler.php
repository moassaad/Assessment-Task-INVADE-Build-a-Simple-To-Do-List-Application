<?php

namespace App\Exceptions;

use App\Services\APIResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (AuthorizationException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->errorForbidden($exception->getMessage(), [$exception->asNotFound()]);
            }
        });
       $this->renderable(function (AuthenticationException $exception, Request $request) 
       {
           if($request->is('api/*'))
           {
               return APIResponse::new()->errorUnauthorized($exception->getMessage(), ["Access Denied! You don't have permission."]);
           }
       });
        $this->renderable(function (HttpResponseException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->error(501,$exception->getMessage(), [$exception->getFile()]);
            }
        });
        $this->renderable(function (ValidationException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->error($exception->status,$exception->getMessage(), [$exception->errors(),$exception->errorBag($exception->getMessage())]);
            }
        });
        $this->renderable(function (NotFoundHttpException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->errorNotFound($exception->getMessage());
            }
        });
        $this->renderable(function (MethodNotAllowedException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->error(405,$exception->getMessage(), ["error"]);
            }
        });
        $this->renderable(function (\RuntimeException $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->errorInternalServerError($exception->getMessage(), [$exception->getPrevious()]);
            }
        });
        $this->renderable(function (\Exception $exception, Request $request) 
        {
            if($request->is('api/*'))
            {
                return APIResponse::new()->errorInternalServerError($exception->getMessage(), [$exception->getTrace()]);
            }
        });
    }
}
