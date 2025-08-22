<?php

namespace Project\models;

use Exception;
use PDO;

final class User extends DataBase
{

    private ?int $id;
    private string $name;
    private string $email;
    private PDO $db;

    public function __construct(string $name, string $email, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->db = $this->connect();
    }

    public function insert(): User
    {
        $stmt = $this->db->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
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
    
}
