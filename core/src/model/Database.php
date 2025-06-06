<?php

namespace model;
use PDO;
use PDOException;
use RuntimeException;


class Database
{
    private static ?PDO $_pdo = null;

    private function __construct()
    {
    } // Empêche l’instanciation directe

    public static function getPdo(): PDO
    {
        if (self::$_pdo === null) {
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            if (!$host || !$dbname || !$user || $pass === false) {
                throw new RuntimeException("Variables d'environnement DB manquantes.");
            }

            try {
                self::$_pdo = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_PERSISTENT => false,
                    ]
                );
            } catch (PDOException $e) {
                throw new RuntimeException("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$_pdo;
    }
}