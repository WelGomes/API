<?php

namespace Project\controller;

use Project\service\UserService;

final class UserController extends UserService implements Controller
{
    public function post(): array
    {
        $json = json_decode(file_get_contents('php://input'), true);

        $nameSanitize = htmlspecialchars($json['name'], ENT_QUOTES);
        $email = filter_var($json['email'], FILTER_SANITIZE_EMAIL);

        return parent::save(name: $nameSanitize, email: $email);
    }
}
