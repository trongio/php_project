<?php

namespace app\controllers;

use app\IRequest;
use app\Router;

class LoginController
{
    public function renderLogin(IRequest $request, Router $router)
    {
        $router->layout = '_login_layout';
        return $router->renderView('login');
    }

    public function login(IRequest $request, Router $router)
    {
        $body = $request->getBody();
        list($success, $message) = $router->database->login($body['email'], $body['password'], $user);
        if (!$success){
            return $router->renderView('login', [
                'errorMessage' => $message,
                'data' => $body
            ]);
        }

        $_SESSION['currentUser'] = $user;
        header('Location: /');
    }

    public function logout(IRequest $request)
    {
        session_destroy();
        header('Location: '.$request->httpReferer);
    }
}