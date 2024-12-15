<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\API\ErrorException;
use App\Exceptions\API\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Services\APIResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try
        {
            $valid = $request->validated();
    
            $user = User::where(['email'=>$valid['email']])->first();
            if($this->isEmailAndPasswordValid($user,$valid['password']))
            {
                $token = $user->createToken($request->userAgent())->plainTextToken;
    
                return APIResponse::new()
                    ->successOk(
                        'welcome',
                        [
                            "user"=>new UserResource($user),
                            "token"=>$token
                        ]
                );
            }
            else
            {
                throw new ErrorException('email and password incorrect' );
            }
        }
        catch(\Exception $e)
        {
            throw new InternalServerErrorException($e->getMessage());
        }
        
    }
    private function isEmailAndPasswordValid(User $user, string $password)
    {
        return $user && Hash::check($password, $user->password);
    }
}
