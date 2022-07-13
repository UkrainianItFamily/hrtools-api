<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\ApplyNewPasswordAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\RegisterRequest;
use App\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Api\ApiController;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Request\Api\Auth\ApplyNewPasswordHttpRequest;
use App\Http\Request\Api\Auth\LoginHttpRequest;
use App\Http\Request\Api\Auth\RegisterHttpRequest;
use App\Http\Request\Api\Auth\ResetPasswordHttpRequest;
use App\Http\Response\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware(
            'auth:api',
                ['except' =>
                    [
                        'login',
                        'register',
                        'resetPassword',
                        'applyNewPassword'
                    ]
                ]
        );
    }

    public function register(
        RegisterHttpRequest $httpRequest,
        RegisterAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ): JsonResponse
    {
        $request = new RegisterRequest(
            $httpRequest->get('email'),
            $httpRequest->get('password'),
            $httpRequest->get('name'),
            $httpRequest->get('lastname'),
            $httpRequest->get('phone')
        );
        $response = $action->execute($request);

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function login(
        LoginHttpRequest $httpRequest,
        LoginAction $action,
        AuthenticationResponseArrayPresenter $authenticationResponseArrayPresenter
    ): JsonResponse
    {
        $request = new LoginRequest(
            $httpRequest->get('email'),
            $httpRequest->get('password'),
        );
        $response = $action->execute($request);

        return $this->successResponse($authenticationResponseArrayPresenter->present($response));
    }

    public function resetPassword(
        ResetPasswordHttpRequest $request,
        ResetPasswordAction $action
    )
    {
        return $action->execute($request);
    }

    public function applyNewPassword(
        ApplyNewPasswordHttpRequest $request,
        ApplyNewPasswordAction $action
    )
    {
        return $action->execute($request);
    }

}
