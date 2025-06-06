<?php

namespace csrf;

class CSRFProtection
{

    public function generateToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            // Génère un token unique et sécurisé
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public function includeToken()
    {
        echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
    }

    public function validateToken($token)
    {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            // Le token est valide
            return true;
        }
        // Le token est invalide
        return false;
    }
}