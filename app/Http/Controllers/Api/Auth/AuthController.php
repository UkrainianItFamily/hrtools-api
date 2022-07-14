<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\ApplyNewPasswordAction;
use App\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Api\ApiController;
use App\Http\Request\Api\Auth\ApplyNewPasswordHttpRequest;
use App\Http\Request\Api\Auth\ResetPasswordHttpRequest;

final class AuthController extends ApiController
{
    public function __construct()
    {
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
