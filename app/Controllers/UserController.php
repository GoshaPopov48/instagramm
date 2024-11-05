<?php

namespace App\Controllers;

use App\Application\Alerts\Alert;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\User\UserService;

class UserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function registr(Request $request): void
    {
        $request->validation([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required', 'password_confirm'],
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Проверьте правильность введеных полей', Alert::DANGER);
            Redirect::to('registr');
        }

        $this->service->registr([
            'email' => $request->post('email'),
            'name' => $request->post('name'),
            'password' => $request->post('password'),
            'password_confirm' => $request->post('password_confirm')
        ]);
        Alert::storeMessage('Регистрация прошла успешно, авторизируйтесь', Alert::SUCCESS);
        Redirect::to('login');
    }

    public function login(Request $request): void
    {
        $request->validation([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (!$request->validationStatus()) {
            Alert::storeMessage('Проверьте правильность введеных полей', Alert::DANGER);
            Redirect::to('login');
        }
        $auth = $this->service->login(
            $request->post('email'),
            $request->post('password')
        );
        if (!$auth) {
            Redirect::to('login');
        } else {
            Redirect::to('profile');
        }
    }

    public function logout(): void
    {
        $this->service->logout();
    }

}