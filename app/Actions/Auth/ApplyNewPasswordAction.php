<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;

class ApplyNewPasswordAction extends ApiController
{
    public function execute(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse();
    }

    private function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'sometimes|required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    private function validationErrorMessages(): array
    {
        return [
            'message' => 'Error, check inserted data and try again later'
        ];
    }

    private function credentials(Request $request): array
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    private function resetPassword($user, $password): void
    {
        $user->password = $password;
        $user->save();
        event(new PasswordReset($user));
    }

    private function sendResetResponse($response): array
    {
        return [
            'message' => 'Password changed successfully',
            'data' => $response,
        ];
    }

    private function sendResetFailedResponse(): array
    {
        return [
            'message' => 'Password has not been changed, check your mail or password'
        ];
    }

    private function broker(): PasswordBroker
    {
        return Password::broker();
    }
}
