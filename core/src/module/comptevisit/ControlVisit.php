<?php

namespace module\comptevisit;

class ControlVisit
{
    private ModelVisit $visitModel;

    public function __construct()
    {
        $this->visitModel = new ModelVisit();
    }

    public function enregistrerVisite(): void
    {
        $ip = $this->getClientIp();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'inconnu';

        $basePath = '/WEBSITEMAKER/public_html';

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $url = $this->cleanPath($requestUri, $basePath);

        $rawReferer = $_SERVER['HTTP_REFERER'] ?? '';
        $currentDomain = $_SERVER['HTTP_HOST'] ?? '';

        if (empty($rawReferer)) {
            // Pas de referer, mettre valeur par défaut
            $referer = '/';
        } else {
            $refererDomain = parse_url($rawReferer, PHP_URL_HOST);

            if ($refererDomain === null || $refererDomain === $currentDomain) {
                $refererPath = parse_url($rawReferer, PHP_URL_PATH) ?? '/';
                $referer = $this->cleanPath($refererPath, $basePath);
            } else {
                $referer = $rawReferer;
            }
        }

        $heureEntree = date('Y-m-d H:i:s');

        $geo = $this->getGeoData($ip);

        $this->visitModel->enregistrerVisite(
            $ip,
            $userAgent,
            $referer,
            $url,
            $heureEntree,
            $geo['pays'],
            $geo['ville']
        );
    }

    private function cleanPath(string $url, string $basePath): string
    {
        if (strpos($url, $basePath) === 0) {
            return substr($url, strlen($basePath)) ?: '/';
        }
        return $url;
    }


    private function getClientIp(): string
    {
        return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    private function getGeoData(string $ip): array
    {
        $json = @file_get_contents("http://ip-api.com/json/{$ip}");
        $data = json_decode($json, true);
        return [
            'pays' => $data['country'] ?? 'Inconnu',
            'ville' => $data['city'] ?? 'Inconnu'
        ];
    }

    public function showAllVisits(): array
    {
        return $this->visitModel->getAllVisits();
    }

    public function showVisitsByIp(string $ip): void
    {
        foreach ($this->visitModel->getVisitsByIp($ip) as $visit) {
            echo "IP: {$visit['ip']} - Heure: {$visit['heure_entree']} - URL: {$visit['url']}<br>";
        }
    }

    public function showRecentVisits(): void
    {
        foreach ($this->visitModel->getRecentVisits() as $visit) {
            echo "IP: {$visit['ip']} - Heure: {$visit['heure_entree']} - URL: {$visit['url']}<br>";
        }
    }

    public function getVisitsByDate(string $date): array
    {
        return $this->visitModel->getVisitsByDate($date);
    }

    public function getIpStats(): array
    {
        return $this->visitModel->getIpStats();
    }
}