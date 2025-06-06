# PepinPHP v4

**PepinPHP** est un framework PHP léger, modulaire et simple à utiliser, basé sur le modèle **HMVC** (Hierarchical Model View Controller).  
Cette version v4 améliore la gestion du routage avec un système de préfixe d’URL dynamique, permettant une configuration facile entre environnement local et production, tout en conservant la simplicité d’utilisation.

---

## Table des matières

- [Présentation](#présentation)  
- [Structure du projet](#structure-du-projet)  
- [Installation](#installation)  
- [Configuration](#configuration)  
- [Utilisation](#utilisation)  
- [Routage](#routage)  
- [Contribution](#contribution)  
- [Contact](#contact)  
- [Licence](#licence)  

---

## Présentation

Minimaliste et efficace, PepinPHP v4 s'adresse aux projets PHP qui veulent garder un contrôle simple sur une architecture HMVC avec une meilleure gestion des URLs.  

Fonctionnalités principales :  
- Routage dynamique avec gestion du préfixe d’URL (local vs prod)  
- Découpage clair des templates  
- Envoi d'emails avec PHPMailer via SMTP configurable  
- Constantes centralisées pour les routes, infos entreprises et médias  

---

## Structure du projet
```
PepinPHP/
├── core/                       # Noyau du projet, fichiers principaux
│   ├── Autoload.php            # Autoloader des classes
│   ├── Bootstrap.php           # Initialisation du framework
│   ├── constantes.php          # Constantes globales (routes, infos, etc.)
│   ├── env.txt                 # Exemple fichier de config environnementale
│   ├── sendmail.php            # Envoi d’e-mails (PHPMailer)
│   ├── phpmailer/              # Librairie PHPMailer
│   │   ├── Exception.php
│   │   ├── PHPMailer.php
│   │   └── SMTP.php
│   └── src/                    # Code source (MVC, middleware, modules)
│       ├── control/            # Contrôleurs
│       │   ├── ControlForm.php
│       │   ├── ControlMain.php
│       │   └── ControlRoute.php
│       ├── csrf/               # Protection CSRF
│       │   └── CSRFProtection.php
│       ├── envloader/          # Gestion variables environnementales
│       │   └── EnvLoader.php
│       ├── log/                # Logs
│       │   └── form-errors.log
│       ├── middleware/         # Middleware génériques
│       │   └── Middleware.php
│       ├── model/              # Modèles / accès base de données
│       │   └── Database.php
│       ├── module/             # Modules fonctionnels
│       │   ├── comptevisit/
│       │   │   ├── ControlVisit.php
│       │   │   └── ModelVisit.php
│       │   ├── newsletter/
│       │   │   ├── ControlNewsletter.php
│       │   │   └── ModelNewsletter.php
│       │   └── users/
│       │       ├── ControlUser.php
│       │       └── ModelUser.php
│       └── view/               # Vues & templates
│           ├── include/
│           │   └── hero.php
│           ├── navigation/
│           │   ├── 404.php
│           │   ├── accueil.php
│           │   └── contact.php
│           └── template/
│               ├── footer.php
│               ├── header.php
│               └── navbar.php
├── template_mail/              # Templates emails
│   ├── contact_form.php
│   └── newsletter_confirm.php
├── public_html/                # Web root (dossier public)
│   ├── .htaccess               # Règles de réécriture
│   ├── favicon.ico
│   ├── favicon.png
│   ├── htaccess.txt            # Exemple de configuration
│   ├── index.php               # Point d’entrée principal
│   ├── licence.txt
│   ├── readme.md
│   └── public/                 # Ressources publiques
│       ├── css/
│       │   └── style.css
│       ├── font/
│       │   ├── Poppins-BlackItalic.ttf
│       │   ├── Poppins-Italic.ttf
│       │   ├── Poppins-Light.ttf
│       │   └── Poppins-Regular.ttf
│       ├── img/
│       │   ├── banner.avif
│       │   └── logo.png
│       └── js/
├── installDatabase.php         # Script d’installation base de données
├── .env                       # Configuration environnementale (non versionnée)
├── README.md                   # Documentation principale
└── LICENSE                    # Licence du projet

```
## Installation

1. Cloner le dépôt :  

git clone https://github.com/WebSiteMaker24/PepinPHP.git
Configurer votre serveur web pour que la racine pointe sur public_html/public/.

Copier env.txt en .env et configurer vos variables (obligatoire) :

# Base de données
DB_HOST=localhost
DB_NAME=nom_de_votre_base
DB_USER=utilisateur
DB_PASS=votre_mot_de_passe

⚠️ L’application ne fonctionne pas sans un fichier .env configuré correctement.

Configuration
Définir vos routes dans url.php :

define('URL_ACCUEIL', '?url=accueil');
define('URL_CONTACT', '?url=contact');
// Ajouter vos routes ici
Configurer SMTP dans sendmail.php :

define('COMPANY_EMAIL', 'votre.email@exemple.com');
define('SMTP_PASSWORD', 'votre_mdp_application_smtp');
// Compléter avec vos identifiants SMTP

Utilisation
Accéder aux pages via ?url=nom_de_la_page.

Le routeur (src/control/ControlRoute.php) charge la vue associée.

Templates header.php, navbar.php, footer.php inclus automatiquement.

Routage
Exemple dans ControlRoute.php :

```
switch ($page) {
            case '':
                $keyword = "PepinPHP, framework PHP, accueil";
                $description = "Bienvenue sur PepinPHP, un framework PHP léger et modulaire. Découvrez comment démarrer rapidement.";
                $canonical = "/accueil";
                $title = "Accueil - PepinPHP";
                $page = '/src/view/navigation/accueil.php';
                break;
            case 'accueil':
                $keyword = "PepinPHP, framework PHP, accueil";
                $description = "Bienvenue sur PepinPHP, un framework PHP léger et modulaire. Découvrez comment démarrer rapidement.";
                $canonical = "/accueil";
                $title = "Accueil - PepinPHP";
                $page = '/src/view/navigation/accueil.php';
                break;
            case 'contact':
                $keyword = "contact, support, PepinPHP, aide";
                $description = "Page de contact de PepinPHP. Pour toute question ou support, contactez-nous.";
                $canonical = "/contact";
                $title = "Contact - PepinPHP";
                $page = '/src/view/navigation/contact.php';
                break;
            default:  // 404
                $keyword = "erreur 404, page non trouvée, PepinPHP";
                $description = "La page demandée n'existe pas ou a été déplacée.";
                $canonical = "/404";
                $title = "Erreur 404 - Page non trouvée - PepinPHP";
                $page = '/src/view/navigation/404.php';
                break;
}
```
Utiliser les constantes URL présente dans le fichier url.php dans les liens :

<a href="<?php echo URL_ACCUEIL; ?>">Accueil</a>
Contribution
Projet open source. Contributions via pull requests ou issues sur GitHub.
Respecter la structure et le style pour faciliter la maintenance.

Contact
Email : contact@websitemaker.fr

GitHub : github.com/WebSiteMaker24

Clone : git clone https://github.com/WebSiteMaker24/PepinPHP.git

Licence : Ce projet est sous licence MIT. Voir le fichier LICENSE.

PepinPHP — Simple, léger, modulaire.
