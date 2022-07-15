<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Auth\PasswordBroker;

final class ResetPasswordAction extends ApiController
{
    public function execute(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse();
    }

    private function validateEmail(Request $request): void
    {
        $request->validate(['email' => 'required|email']);
    }

    private function credentials(Request $request): array
    {
        return $request->only('email');
    }

    private function sendResetLinkResponse($response): array
    {
        return [
            'message' => 'Mail has been sent for password reset',
            'data' => $response,
        ];
    }

    private function sendResetLinkFailedResponse(): array
    {
        return [
            'message' => 'Mail has not been sent, try again later'
        ];
    }

    private function broker(): PasswordBroker
    {
        return Password::broker();
    }
}
