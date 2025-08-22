<?php

namespace Project\service;

use Exception;
use Project\models\User;

abstract class UserService
{

    protected function save(string $name, string $email, string $password): array
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

        if (!preg_match($pattern, $password) || strlen($password) < 6) {
            throw new Exception("A senha não é forte o suficiente. " .
                "Ela deve conter no mínimo 6 caracteres, incluindo pelo menos uma letra maiúscula, " .
                "uma letra minúscula, um número e um caractere especial.");
        }

        if (empty($name) || empty($email)) {
            throw new Exception("Todos os campos tem que ser preenchidos");
        }

        $user = new User(
            name: $name,
            email: $email,
            password: password_hash($password, PASSWORD_ARGON2ID)
        );

        $userReturn = $user->insert();

        return [
            'id' => $userReturn->getId(),
            'name' => $userReturn->getName(),
            'email' => $userReturn->getEmail(),
        ];
    }
}
