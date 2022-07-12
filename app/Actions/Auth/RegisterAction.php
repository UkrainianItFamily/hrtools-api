<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Repository\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Mail\Mailer;
use App\Mail\WelcomeEmail;
use Tymon\JWTAuth\Facades\JWTAuth;


final class RegisterAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(RegisterRequest $request): AuthenticationResponse
    {
        $user = $this->userRepository->create([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
            'name' => $request->getName(),
            'lastname' => $request->getLastName(),
            'phone' => $request->getPhone()
        ]);

        $token = JWTAuth::fromUser($user);

        event(new Registered($user));

        return new AuthenticationResponse(
            $token,
            'bearer',
            auth('api')->factory()->getTTL() * 60
        );
    }
}
