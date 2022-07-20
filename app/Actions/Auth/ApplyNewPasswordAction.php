<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ApplyNewPasswordAction extends ApiController
{
    public function __construct(private ChangePasswordResponse $changePasswordResponse)
    {
    }

    public function execute(Request $request): array
    {
        $response = Password::reset(
            $request->only('token', 'email', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $this->changePasswordResponse->getResponse($response,  Password::PASSWORD_RESET);
    }
}
