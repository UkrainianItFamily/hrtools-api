<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Services\SendsPasswordResetEmails;
use Illuminate\Http\Request;

final class ResetPasswordAction extends ApiController
{
    use SendsPasswordResetEmails;

    public function execute($request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
