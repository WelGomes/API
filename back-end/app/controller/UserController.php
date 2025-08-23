<?php

namespace Project\controller;

use Project\service\UserService;

final class UserController implements Controller
{
    private UserService $userService;

    public function __construct()
    {
        $json = json_decode(file_get_contents('php://input'), true);
        
        $id = $_GET['id'] ?? null;
        $name = htmlspecialchars($json['name'], ENT_QUOTES);
        $email = filter_var($json['email'], FILTER_VALIDATE_EMAIL);
        $password = $json['password'];

        $this->userService = new UserService(
            name: $name,
            email: $email,
            password: $password,
            id: $id,
        );
    }

    public function post(): array
    {
        return $this->userService->save();
    }

    public function get(): array
    {
        return $this->userService->getUser();
    }
}
