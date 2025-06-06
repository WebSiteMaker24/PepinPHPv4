<?php

namespace module\comptevisit;

use model\Database;
use \PDO;

class ModelVisit
{
    private PDO $_pdo;

    public function __construct()
    {
        $this->_pdo = Database::getPdo(); // Singleton 
    }

    public function getAllVisits(): array
    {
        $stmt = $this->_pdo->query("SELECT * FROM visites ORDER BY heure_entree DESC");
        return $stmt->fetchAll();
    }

    public function getVisitsByIp(string $ip): array
    {
        $stmt = $this->_pdo->prepare("SELECT * FROM visites WHERE ip = ? ORDER BY heure_entree DESC");
        $stmt->execute([$ip]);
        return $stmt->fetchAll();
    }

    public function getRecentVisits(): array
    {
        $stmt = $this->_pdo->query("SELECT * FROM visites WHERE heure_entree > NOW() - INTERVAL 1 DAY ORDER BY heure_entree DESC");
        return $stmt->fetchAll();
    }

    public function enregistrerVisite(
        string $ip,
        string $user_agent,
        string $referer,
        string $url,
        string $heure_entree,
        string $pays,
        string $ville
    ): bool {
        $sql = "INSERT INTO visites (ip, user_agent, referer, url, heure_entree, pays, ville) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute([$ip, $user_agent, $referer, $url, $heure_entree, $pays, $ville]);
        return $stmt->rowCount() > 0;
    }

    public function getVisitsByDate(string $date): array
    {
        $stmt = $this->_pdo->prepare("SELECT * FROM visites WHERE DATE(heure_entree) = ? ORDER BY heure_entree DESC");
        $stmt->execute([$date]);
        return $stmt->fetchAll();
    }

    public function getIpStats(): array
    {
        $stmt = $this->_pdo->query("SELECT ip, COUNT(*) as total_visits FROM visites GROUP BY ip ORDER BY total_visits DESC");
        return $stmt->fetchAll();
    }
}