<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\User;

final class UserArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'first_name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'phone' => $user->getPhone(),
            'email_verified_at' => $user->getVerifiedEmail(),
        ];
    }
}
