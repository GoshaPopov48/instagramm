<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function registr(array $data): void;

    public function login(string $username, string $password): bool;

    public function logout(): void;
}