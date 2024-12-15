<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\API\InternalServerErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\APIResponse;
use Hash;
use Illuminate\Http\Request;
use Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        $user = new User();
        $creaditionals = $request->validated();

        $userAtterbute = [
            "user_id"    => Str::random(10),
            "name" => $creaditionals['name'],
            "email"     => $creaditionals['email'],
            "password"  => Hash::make($creaditionals['password']),
        ];
        
        $user->setRawAttributes($userAtterbute);
        $checkSave = $user->save();
        
        if(!$checkSave) {
            throw new InternalServerErrorException('error register user date');
        }
        $tokenName = $request->userAgent();
        $token = $user->createToken($tokenName)->plainTextToken;
        return APIResponse::new()
            ->successOk(
                'success register save',
                [
                    "user"=>new UserResource($user),
                    "token"=>$token
                ]
        );
    }
}
