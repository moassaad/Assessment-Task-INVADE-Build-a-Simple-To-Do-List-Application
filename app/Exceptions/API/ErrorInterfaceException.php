<?php

namespace App\Exceptions\API;

use Illuminate\Http\Request;

interface ErrorInterfaceException
{
    public function report();
    public function render(Request $request);
}