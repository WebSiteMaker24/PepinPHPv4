<?php
// Index.php

declare(strict_types=1);

// Afficher toutes les erreurs (à supprimer en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$path = __DIR__ . "/../core/";
require_once $path . "constantes.php";
require_once $path . "Autoload.php";
require_once $path . "Bootstrap.php";

$app = new Bootstrap();
$app->run();