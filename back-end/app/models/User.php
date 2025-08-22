<?php

namespace Project\models;

use Exception;
use PDO;

final class User extends DataBase
{

    private ?int $id;
    private string $name;
    private string $email;
    private string $password;
    private PDO $db;

    public function __construct(string $name, string $email, string $password, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->db = $this->connect();
    }

    public function insert(): User
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $result = $stmt->execute();

        if (!$result) {
            throw new Exception("Erro ao registrar usuário");
        }

        $this->id = $this->db->lastInsertId();
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
}
