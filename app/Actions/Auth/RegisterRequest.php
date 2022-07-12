<?php

declare(strict_types=1);

namespace App\Actions\Auth;

final class RegisterRequest
{
    public function __construct(
        private string $email,
        private string $password,
        private string $name,
        private string $lastname,
        private string $phone
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}

