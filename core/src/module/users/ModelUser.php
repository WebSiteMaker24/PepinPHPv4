<?php

namespace module\users;

use model\Database;
use \PDO;

class UserModel
{
    private PDO $_pdo;

    public function __construct()
    {
        $this->_pdo = Database::getPdo(); // Singleton
    }

    public function create(array $data): int|false
    {
        $sql = "INSERT INTO users (
            nom, prenom, email, mot_de_passe, entreprise, telephone,
            adresse_postale, adresse_ip, referer_url, role, email_valide,
            token_validation_email, accepte_cgu, date_acceptation_cgu,
            provider, provider_id, actif
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

        $stmt = $this->_pdo->prepare($sql);

        $stmt->execute([
            $data['nom'] ?? null,
            $data['prenom'] ?? null,
            $data['email'],
            $data['mot_de_passe'],
            $data['entreprise'] ?? null,
            $data['telephone'] ?? null,
            $data['adresse_postale'] ?? null,
            $data['adresse_ip'] ?? null,
            $data['referer_url'] ?? null,
            $data['role'] ?? 'user',
            $data['email_valide'] ?? false,
            $data['token_validation_email'] ?? null,
            $data['accepte_cgu'] ?? false,
            $data['date_acceptation_cgu'] ?? null,
            $data['provider'] ?? 'local',
            $data['provider_id'] ?? null,
            $data['actif'] ?? true
        ]);

        return $this->_pdo->lastInsertId() ?: false;
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->_pdo->prepare("SELECT * FROM users WHERE id = ? AND actif = 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getByEmail(string $email): ?array
    {
        $stmt = $this->_pdo->prepare("SELECT * FROM users WHERE email = ? AND actif = 1");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getByProvider(string $provider, string $providerId): ?array
    {
        $stmt = $this->_pdo->prepare("SELECT * FROM users WHERE provider = ? AND provider_id = ? AND actif = 1");
        $stmt->execute([$provider, $providerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $allowed = [
            'nom',
            'prenom',
            'email',
            'mot_de_passe',
            'entreprise',
            'telephone',
            'adresse_postale',
            'adresse_ip',
            'referer_url',
            'role',
            'email_valide',
            'token_validation_email',
            'accepte_cgu',
            'date_acceptation_cgu',
            'provider',
            'provider_id',
            'actif',
            'date_derniere_connexion'
        ];

        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowed)) {
                $fields[] = "$key = ?";
                $params[] = $value;
            }
        }

        if (empty($fields))
            return false;

        $params[] = $id;

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->_pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->_pdo->prepare("UPDATE users SET actif = 0 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllActive(): array
    {
        $stmt = $this->_pdo->query("SELECT * FROM users WHERE actif = 1 ORDER BY date_creation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function emailExists(string $email): bool
    {
        $stmt = $this->_pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND actif = 1");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function login(string $email, string $password): ?array
    {
        $user = $this->getByEmail($email);
        if (!$user) {
            return null;
        }
        if (password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return null;
    }
}