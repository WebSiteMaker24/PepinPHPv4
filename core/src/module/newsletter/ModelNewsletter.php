<?php

namespace module\newsletter;

use model\Database;
use \PDO;

class ModelNewsletter
{
    private PDO $_pdo;

    public function __construct()
    {
        $this->_pdo = Database::getPdo(); // Singleton
    }

    public function insert(string $email): bool
    {
        $token = bin2hex(random_bytes(32));
        $sql = "INSERT INTO newsletter (email, unsubscribe_token) VALUES (:email, :token)";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        return $stmt->execute();
    }
    // Met à jour is_subscribed à 0 pour désabonner
    public function unsubscribeTest(string $email): bool
    {
        $sql = "UPDATE newsletter SET is_subscribed = 0 WHERE email = :email";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function delete(string $email): bool
    {
        $sql = "DELETE FROM newsletter WHERE email = :email";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAll(): array
    {
        $sql = "SELECT email FROM newsletter WHERE is_subscribed = 1 ORDER BY subscribed_at DESC";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }

    public function exists(string $email): bool
    {
        $sql = "SELECT 1 FROM newsletter WHERE email = :email LIMIT 1";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }
    public function getSubscribedEmails(): array
    {
        $sql = "SELECT email FROM newsletter WHERE is_subscribed = 1";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }
    // A tester 
    public function subscribe(string $email): bool
    {
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE newsletter 
                SET is_subscribed = 1, subscribed_at = :now, unsubscribed_at = NULL 
                WHERE email = :email";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':now', $now, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $updated = $stmt->execute();

        // Si email n'existe pas, on l'insère
        if (!$updated || $stmt->rowCount() === 0) {
            // On crée un token unique pour unsubscribe_token
            $token = bin2hex(random_bytes(32));
            $sqlInsert = "INSERT INTO newsletter (email, unsubscribe_token, is_subscribed, subscribed_at, unsubscribed_at)
                          VALUES (:email, :token, 1, :now, NULL)";
            $stmtInsert = $this->_pdo->prepare($sqlInsert);
            $stmtInsert->bindValue(':email', $email, PDO::PARAM_STR);
            $stmtInsert->bindValue(':token', $token, PDO::PARAM_STR);
            $stmtInsert->bindValue(':now', $now, PDO::PARAM_STR);
            return $stmtInsert->execute();
        }

        return $updated;
    }

    public function unsubscribe(string $email): bool
    {
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE newsletter 
                SET is_subscribed = 0, unsubscribed_at = :now 
                WHERE email = :email";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->bindValue(':now', $now, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }
}