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
