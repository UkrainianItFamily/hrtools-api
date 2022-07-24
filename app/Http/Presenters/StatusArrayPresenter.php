<?php

declare(strict_types=1);

namespace App\Http\Presenters;

use Illuminate\Support\Collection;
use App\Actions\Status\StatusParameter;
use App\Contracts\PresenterCollectionInterface;

final class StatusArrayPresenter implements PresenterCollectionInterface
{
    public function present(StatusParameter $statusParameter): array
    {
        return [
            'name' => $statusParameter->getName(),
            'value' => $statusParameter->getValue(),
        ];
    }

    public function presentCollection(Collection $statusParameters): array
    {
        return $statusParameters->map(fn (StatusParameter $parameter) => $this->present($parameter))->all();
    }
}
