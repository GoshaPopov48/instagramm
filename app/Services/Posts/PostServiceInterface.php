<?php

namespace App\Services\Posts;

interface PostServiceInterface
{
    public function store(array $image, ?string $description): void;

    public function destroy(int $id): void;
}