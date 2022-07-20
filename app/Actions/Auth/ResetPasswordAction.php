<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

final class ResetPasswordAction extends ApiController
{

    public function __construct(private ChangePasswordResponse $changePasswordResponse)
    {
    }

    public function execute(Request $request): array
    {
        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $this->changePasswordResponse->getResponse($response,  Password::RESET_LINK_SENT);
    }
}
