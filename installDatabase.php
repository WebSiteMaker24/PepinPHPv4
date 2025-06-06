<?php

class InstallDatabase
{
    private PDO $_pdo;

    public function __construct(PDO $pdo)
    {
        $this->_pdo = $pdo;
    }

    public function createUsersTable(): bool
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100),
                prenom VARCHAR(100),
                email VARCHAR(255) NOT NULL UNIQUE,
                mot_de_passe VARCHAR(255) NOT NULL,
                entreprise VARCHAR(255),
                telephone VARCHAR(50),
                adresse_postale TEXT,
                adresse_ip VARCHAR(45),
                referer_url TEXT,
                role VARCHAR(50) DEFAULT 'user',
                email_valide TINYINT(1) DEFAULT 0,
                token_validation_email VARCHAR(255),
                accepte_cgu TINYINT(1) DEFAULT 0,
                date_acceptation_cgu DATETIME,
                provider VARCHAR(100) DEFAULT 'local',
                provider_id VARCHAR(255),
                date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
                date_derniere_connexion DATETIME,
                actif TINYINT(1) DEFAULT 1
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        return (bool) $this->_pdo->exec($sql);
    }

    public function createVisitTable(): bool
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS visites (
                id INT AUTO_INCREMENT PRIMARY KEY,
                ip VARCHAR(45),
                user_agent TEXT,
                referer TEXT,
                url TEXT,
                heure_entree DATETIME,
                pays VARCHAR(100),
                ville VARCHAR(100),
                vpn TINYINT(1) NOT NULL DEFAULT 0,
                largeur_ecran INT
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        return (bool) $this->_pdo->exec($sql);
    }
}