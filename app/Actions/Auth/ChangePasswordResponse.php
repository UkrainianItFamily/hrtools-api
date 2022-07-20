<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class ChangePasswordResponse
{
    public function getResponse(string $response, string $systemValue): array
    {
        return $response === $systemValue
            ?$this->success($response)
            :$this->failed($response);
    }

    private function success(string $response): array
    {
        return ['status' => __($response)];
    }

    private function failed(string $response): array
    {
        return ['status' => __($response)];
    }
}
