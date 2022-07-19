<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

final class ResetPasswordAction extends ApiController
{
    public function execute(Request $request)
    {
        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response === Password::RESET_LINK_SENT
            ? ['status' => __($response)]
            : ['email' => __($response)];

    }
}
