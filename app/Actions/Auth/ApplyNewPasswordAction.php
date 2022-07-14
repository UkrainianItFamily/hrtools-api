<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Services\ResetsPasswords;

class ApplyNewPasswordAction extends ApiController
{
    use ResetsPasswords;

    public function execute($request)
    {
        return $this->reset($request);
    }
}
