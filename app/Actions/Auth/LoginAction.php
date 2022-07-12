<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

final class LoginAction
{
    public function execute(LoginRequest $request): AuthenticationResponse
    {
        $authResult = Auth::attempt([
            'email' => $request->getEmail(),
            'password' => $request->getPassword()
        ]);

        if (!$authResult ) {
            throw new AuthenticationException();
        }

        $token = JWTAuth::fromUser(
            Auth::user()
        );

        return new AuthenticationResponse(
            $token,
            'bearer',
            auth('api')->factory()->getTTL() * 60
        );
    }
}
