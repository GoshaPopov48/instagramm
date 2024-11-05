<?php

use App\Models\User;

return [
    'model' => User::class,
    'username_column' => 'email',
    'token_column' => 'token',
];