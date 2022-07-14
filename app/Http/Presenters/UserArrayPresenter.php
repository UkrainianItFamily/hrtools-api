<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use App\Contracts\PresenterCollectionInterface;
use App\Models\User;
use Illuminate\Support\Collection;

final class UserArrayPresenter implements PresenterCollectionInterface
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'lastname' => $user->getLastName(),
            'phone' => $user->getPhone()
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection->map(fn (User $user) => $this->present($user))->all();
    }
}
