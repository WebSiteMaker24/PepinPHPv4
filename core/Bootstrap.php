<?php

// Bootstrap.php

use envloader\EnvLoader;
use control\ControlForm;
use middleware\Middleware;
use csrf\CSRFProtection;
use module\newsletter\ControlNewsletter;
class Bootstrap
{
    public function run(): void
    {
        date_default_timezone_set('Europe/Paris');

        // 🌐 Chargement des variables d'environnement
        $env = new EnvLoader(__DIR__ . "/.env");
        $env->load();

        // 🛡️ Exécution du middleware statique
        Middleware::middleware();

        // 🔐  Protection CSRF
        $csrfProtection = new CSRFProtection();
        $csrfProtection->generateToken();

        // Enregistre les mails de la newsletter
        $controlNewsletter = new ControlNewsletter();

        // Le gestionnaire de formulaire (avec la protection csrf, et tout les modules qui ont besoins de formulaire "commentaire" "post" "newsletter" ...)
        $controlForm = new ControlForm($csrfProtection, $controlNewsletter);
        $controlForm->handleRequest();

        // 👤 Module comptevisit - enregistrement des visites (La base de données doit être connectée avant utilisation)
        $visitControl = new \module\comptevisit\ControlVisit();
        $visitControl->enregistrerVisite();

        // 🚦 Récupération de l'URL demandée (routeur)
        $url = $_GET['url'] ?? 'accueil';

        // 🛣️ Appel du routeur pour gérer la requête
        $router = new \control\ControlRoute($url);
        $router->route();
    }
}