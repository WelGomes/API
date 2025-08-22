<?php

namespace Project\service;

use Exception;
use Project\models\User;

abstract class UserService
{
    protected function save(string $name, string $email): array
    {
        if (empty($name) || empty($email)) {
            throw new Exception("Todos os campos tem que ser preenchidos");
        }

        $user = new User(name: $name, email: $email);

        $userReturn = $user->insert();

        return [
            'id' => $userReturn->getId(),
            'name' => $userReturn->getName(),
            'email' => $userReturn->getEmail()
        ];
    }
}
