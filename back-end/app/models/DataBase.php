<?php

namespace Project\models;

use Exception;
use PDO;
use PDOException;

abstract class DataBase
{

    private static string $DB_HOST;
    private static string $DB_NAME;
    private static string $DB_USER;
    private static string $DB_PASSWORD;

    protected function connect(): PDO
    {
        self::$DB_HOST = $_ENV['DB_HOST'];
        self::$DB_NAME = $_ENV['DB_NAME'];
        self::$DB_USER = $_ENV['DB_USER'];
        self::$DB_PASSWORD = $_ENV['DB_PASSWORD'];
        try {
            $pdo = new PDO("mysql:host=". self::$DB_HOST . ";dbname=" . self::$DB_NAME, self::$DB_USER, self::$DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception("Erro na conexão com o banco: " . $e->getMessage());
        }
    }
}
