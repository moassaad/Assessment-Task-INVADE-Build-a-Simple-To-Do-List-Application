<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\API\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\APIResponse;
use Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        try
        {
            if(Auth::check())
            {
                $user = Auth::user();
                
                Auth::user()->tokens()->find(
                    Auth::user()->currentAccessToken()->id
                )->delete();
            
                return APIResponse::new()->successOk("logout successful", new UserResource($user));
            }
            else
            {
                return APIResponse::new()->errorUnauthorized("Unauthorized");
            }
        }
        catch(\Exception $error)
        {
            throw new InternalServerErrorException($error->getMessage());
        }
    }
}
