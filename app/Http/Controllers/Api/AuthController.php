<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\ForgotPasswordAction;
use App\Actions\Auth\ForgotPasswordRequest;
use App\Actions\Auth\GetAuthenticatedUserAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\ResetPasswordRequest;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Presenters\UserArrayPresenter;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Http\Requests\Api\Auth\PasswordResetLinkRequest;
use App\Http\Requests\Api\Auth\ResetRequest;

final class AuthController extends ApiController
{

    public function login(
        AuthRequest $authRequest,
        LoginAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ) {
        $request = new LoginRequest(
            $authRequest->email,
            $authRequest->password
        );

        $response = $action->execute($request);

        if(!$response->getExpiresIn()){
            return $this->errorResponse('Unauthorized');
        }

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function forgotPassword(
        PasswordResetLinkRequest $passwordResetLinkRequest,
        ForgotPasswordAction $action
    ) {
        $request = new ForgotPasswordRequest(
            $passwordResetLinkRequest->email
        );

        $action->execute($request);

        return $this->successResponse(['msg' => __('passwords.sent')], 200);
    }

    public function reset(
        ResetRequest $resetRequest,
        ResetPasswordAction $action
    ) {
        $request = new ResetPasswordRequest(
            $resetRequest->token,
            $resetRequest->email,
            $resetRequest->password,
            $resetRequest->password_confirmation
        );

        $action->execute($request);

        return $this->successResponse(['msg' => __('passwords.reset')], 200);
    }

    public function logout(
        LogoutAction $action
    )
    {
        $action->execute();

        return $this->emptyResponse();
    }

    public function me(GetAuthenticatedUserAction $action, UserArrayPresenter $userArrayPresenter)
    {
        $response = $action->execute();

        return $this->SuccessResponse($userArrayPresenter->present($response->getUser()));
    }

}
