<?php

namespace App\Models;

use App\Application\Database\Model;

class Post extends Model
{
    protected string $table = 'posts';
    protected array $fields = ['image', 'description', 'user_id'];

    protected string $image;
    protected ?string $description;
    protected ?int $user_id;

    public function setUser(int $user): void
    {
        $this->user_id = $user;
    }

    public function GetImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

}