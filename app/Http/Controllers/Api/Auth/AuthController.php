<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Http\Controllers\Api\ApiController;
use App\Http\Presenters\AuthenticationResponseArrayPresenter;
use App\Http\Request\Api\Auth\LoginHttpRequest;

use Illuminate\Http\JsonResponse;

final class AuthController extends ApiController
{
    public function __construct()
    {
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

}
