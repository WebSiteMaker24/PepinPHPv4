<?php

namespace middleware;

class Middleware
{
    public static function middleware()
    {
        self::activeSession();
        self::antiVolSession();
        self::sanitizeGlobals();
    }

    // Nettoie les données d'entrée (trim + strip_tags)
    public static function sanitize($data)
    {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }

        // Supprime les balises HTML mais garde les caractères spéciaux tels quels
        return strip_tags(trim($data));
    }

    // Méthode à appeler au démarrage pour nettoyer les superglobales
    public static function sanitizeGlobals()
    {
        $_GET = self::sanitize($_GET);
        $_POST = self::sanitize($_POST);
        $_COOKIE = self::sanitize($_COOKIE);

        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = self::sanitize($_SESSION);
        }
    }

    // Démarrage sécurisé de la session
    public static function activeSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
            ini_set('session.use_only_cookies', 1);
            session_start();
        }
    }

    // Définition du cookie de session avec sécurité renforcée
    public static function activeCookie()
    {
        session_name('SESSION_ID');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    // Protection contre le vol de session
    public static function antiVolSession($force = false)
    {
        $sessionTimeout = 3600; // 1h
        $userIP = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        if (isset($_SESSION['initiated']) && (time() - $_SESSION['initiated'] > $sessionTimeout)) {
            session_destroy();
            session_start();
        }

        if (!isset($_SESSION['initiated']) || $force) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = time();
            $_SESSION['user_ip'] = $userIP;
            $_SESSION['user_agent'] = $userAgent;
        } else {
            if ($_SESSION['user_ip'] !== $userIP || $_SESSION['user_agent'] !== $userAgent) {
                session_destroy();
                session_start();
            }
        }
    }

    // Sécurise le cookie contre le vol (optionnel)
    public static function antiVolCookie($force = false)
    {
        if (!isset($_COOKIE['SESSION_ID']) || $force) {
            $cookieParams = [
                'lifetime' => 0,
                'path' => '/',
                'domain' => '',
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true,
                'samesite' => 'Strict'
            ];

            setcookie('SESSION_ID', session_id(), time() + 3600, '/', '', $cookieParams['secure'], $cookieParams['httponly']);
            session_regenerate_id(true);
        }

        if (!isset($_COOKIE['initiated']) || $force) {
            $_COOKIE['initiated'] = time();
        }
    }
}
