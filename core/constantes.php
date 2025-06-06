<?php
// constantes.php
// Utilisation de constante pour les routes et informations de votre entreprise afin de centraliser ces données

// Url prefix
if (!defined('URL_PREFIX')) // "?url=" en local, et "/" en prod
    define('URL_PREFIX', '?url=');

// Navigation
if (!defined('URL_ACCUEIL')) // Chemin vers la page d'accueil
    define('URL_ACCUEIL', URL_PREFIX . 'accueil');
if (!defined('URL_CONTACT')) // Chemin vers la page de contact
    define('URL_CONTACT', URL_PREFIX . 'contact');

// Autres
if (!defined('URL_CONFIRM')) // Page du mail de confirmation
    define('URL_CONFIRM', URL_PREFIX . 'confirm');

// 404
if (!defined('URL_404'))
    define('URL_404', URL_PREFIX . '404');

// Autres liens (réseaux sociaux ou autres)
if (!defined('URL_FACEBOOK')) // Chemin vers votre page facebook
    define('URL_FACEBOOK', 'Lien vers la page facebook ici');
if (!defined('URL_GOOGLE')) // Chemin vers votre fiche google
    define('URL_GOOGLE', 'Lien vers la fiche google ici');

// Domaine
if (!defined('URL_DOMAINE')) // Votre domaine ici
    define('URL_DOMAINE', 'https://votredomaine.fr');


// Information entreprise
if (!defined('COMPANY_EMAIL'))
    define('COMPANY_EMAIL', 'votremail@ici.fr');
if (!defined('COMPANY_NAME'))
    define('COMPANY_NAME', 'Nom de votre entreprise ici');
if (!defined('COMPANY_PHONE'))
    define('COMPANY_PHONE', 'Numéro de téléphone ici');
if (!defined('COMPANY_PHONE_LINK'))
    define('COMPANY_PHONE_LINK', 'Numéro de téléphone sans espace pour les href');
if (!defined('COMPANY_ADDRESS'))
    define('COMPANY_ADDRESS', 'Adresse ou ville de votre entreprise');

// Geo information (balise meta)
if (!defined('GEO_PLACENAME'))
    define('GEO_PLACENAME', 'Votre ville ici');
if (!defined('GEO_REGION'))
    define('GEO_REGION', 'Votre région ici');
if (!defined('GEO_POSITION'))
    define('GEO_POSITION', 'Votre point gps ici');

// Images
if (!defined('IMG_LOGO')) // Route vers le logo de votre entreprise
    define('IMG_LOGO', 'public/img/logo.png');
if (!defined('IMG_OG')) // Route vers le logo de votre entreprise
    define('IMG_OG', 'public/img/og_img.png');