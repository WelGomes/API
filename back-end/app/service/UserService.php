<?php

namespace Project\service;

use Exception;
use Project\models\User;

final class UserService
{
    private User $user;

    public function __construct(
        string $name,
        string $email,
        string $password,
        ?int $id,
    ) {
        $this->user = $this->verifyVariabel(
            name: $name,
            email: $email,
            password: $password,
            id: $id,
        );
    }

    private function verifyVariabel(
        string $name,
        string $email,
        string $password,
        ?int $id,
    ): User {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/';

        if (!preg_match($pattern, $password) || strlen($password) < 6) {
            throw new Exception(
                "A senha não é forte o suficiente. " .
                    "Ela deve conter no mínimo 6 caracteres, incluindo pelo menos uma letra maiúscula, " .
                    "uma letra minúscula, um número e um caractere especial."
            );
        }

        if (empty($name) || empty($email)) {
            throw new Exception("Todos os campos tem que ser preenchidos");
        }

        return new User(
            name: $name,
            email: $email,
            password: password_hash($password, PASSWORD_ARGON2ID),
            id: $id,
        );
    }

    public function save(): array
    {
        $userReturn = $this->user->insert();
        return [
            'id' => $userReturn->getId(),
            'name' => $userReturn->getName(),
            'email' => $userReturn->getEmail(),
        ];
    }

    public function get(): array
    {
        $userReturn = $this->user->get();
        return [
            'id' => $userReturn->getId(),
            'name' => $userReturn->getName(),
            'email' => $userReturn->getEmail(),
        ];
    }
}
