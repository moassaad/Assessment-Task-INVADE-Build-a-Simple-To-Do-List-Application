<?php

namespace App\Support;

use Response;

class SupportResponseFactory
{
    private mixed $content = '';
    private int $status = 200;
    private array $headers = [];
    private $response;
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function addContent($content)
    {
        $this->content[] = $content;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function setHeader(array $header)
    {
        $this->headers = $header;
    }
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }
    public function response(mixed $content = '', int $status = 200, array $headers = [])
    {
        return $this->response = response($content, $status, $headers);
    }
    public function responseJson($data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        return $this->response = response()->json($data, $status, $headers);
    }
}
