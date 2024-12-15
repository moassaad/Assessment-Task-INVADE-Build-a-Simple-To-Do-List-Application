<?php

namespace App\Services;

use ApiResource\App\API\APIResource;
use ApiResource\App\API\Facade\Cases\APICases;
use App\Support\SupportResponseFactory;

class APIResponse
{
    private $apiData;
    private $responseFactory;
    public function __construct()
    {
        $this->apiData = new APIResource();
        $this->responseFactory = new SupportResponseFactory();
    }
    public static function new()
    {
        return new self();
    }
    /**
     * Summary of success
     * @param mixed $status
     * @param mixed $message
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function success($status, $message = "", $data = null)
    {
        $content = $this->apiData->success($status, $message, $data);
        return $this->responseFactory->response($content, APICases::OK);
    }
    public function successOk($message = "", $data = null)
    {
        $content = $this->apiData->successOk($message, $data);
        return $this->responseFactory->response($content, APICases::OK);
    }
    public function successCreated($message = "", $data = null)
    {
        $content = $this->apiData->successCreated($message, $data);
        return $this->responseFactory->response($content, APICases::CREATED);
    }
    public function successNoContent($message = "", $data = null)
    {
        $content = $this->apiData->successNoContent($message, $data);
        return $this->responseFactory->response($content, APICases::NO_CONTENT);
    }
    public function successNotModified($message = "", $data = null)
    {
        $content = $this->apiData->successNotModified($message, $data);
        return $this->responseFactory->response($content, APICases::NOT_MODIFIED);
    }
    
    /**
     * Summary of error
     * @param mixed $status
     * @param mixed $message
     * @param mixed $errors
     * @return \Illuminate\Http\Response
     */
    public function error($status, $message, $errors)
    {
        $content = $this->apiData->error($status, $message, $errors);
        return $this->responseFactory->response($content, $status);
    }
    public function errorBadRequest($message, $errors = ['Bad Request.'])
    {
        $content = $this->apiData->errorBadRequest($message, $errors);
        return $this->responseFactory->response($content, APICases::BAD_REQUEST);
    }
    public function errorUnauthorized($message, $errors = ["Unauthorized."])
    {
        $content = $this->apiData->errorUnauthorized($message, $errors);
        return $this->responseFactory->response($content, APICases::UNAUTHORIZED);
    }
    public function errorForbidden($message, $errors = ["Forbidden."])
    {
        $content = $this->apiData->errorForbidden($message, $errors);
        return $this->responseFactory->response($content, APICases::FORBIDDEN);
    }
    public function errorNotFound($message, $errors = ["Not Found."])
    {
        $content = $this->apiData->errorNotFound($message, $errors);
        return $this->responseFactory->response($content, APICases::NOT_FOUND);
    }
    public function errorConflict($message, $errors = ["Conflict."])
    {
        $content = $this->apiData->errorConflict($message, $errors);
        return $this->responseFactory->response($content, APICases::CONFLICT);
    }
    public function errorInternalServerError($message, $errors = ["Internal Server Error."])
    {
        $content = $this->apiData->errorInternalServerError($message, $errors);
        return $this->responseFactory->response($content, APICases::INTERNAL_SERVER_ERROR);
    }
}
