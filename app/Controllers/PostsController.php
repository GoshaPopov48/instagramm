<?php

namespace App\Controllers;

use App\Application\Request\Request;
use App\Services\Posts\PostService;

class PostsController
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function publish(Request $request): void
    {
        // сделать валидациб для файла
        $this->service->store($request->file('image'), $request->post('description'));
    }

}