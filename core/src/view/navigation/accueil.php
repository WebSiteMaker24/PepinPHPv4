<!-- src/view/navigation/accueil.php -->
<style>
    .container {
        max-width: 900px;
        margin: 30px auto;
        padding: 20px;
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        line-height: 1.6;
    }

    h1 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 20px;
        border-bottom: 3px solid #2980b9;
        padding-bottom: 8px;
    }

    h2 {
        font-size: 1.8rem;
        color: #2980b9;
        margin-top: 30px;
        margin-bottom: 15px;
        border-left: 5px solid #2980b9;
        padding-left: 12px;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    ul,
    ol {
        margin-left: 20px;
        margin-bottom: 20px;
    }

    code {
        background-color: #eee;
        padding: 2px 5px;
        font-family: Consolas, monospace;
        font-size: 0.95rem;
        border-radius: 3px;
        color: #c7254e;
    }

    pre {
        background-color: #272822;
        color: #f8f8f2;
        padding: 12px 15px;
        border-radius: 5px;
        overflow-x: auto;
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 20px;
    }

    pre code {
        background: none;
        color: inherit;
        padding: 0;
        font-family: monospace;
    }
</style>

<div class="container">
    <h1>Bienvenue sur PepinPHP <img src="<?= IMG_LOGO; ?>" alt="PepinPHP Logo" class="logo"></h1>
    <p>
        PepinPHP est un framework PHP léger et modulaire basé sur le modèle HMVC.
        Il gère automatiquement le routage, l'affichage des vues et l'organisation en modules.
    </p>

    <h2>Nouveautés de la version 4</h2>
    <ul>
        <li>✨ Autoload PSR-4 pour un chargement automatique des classes</li>
        <li>📋 Gestionnaire de formulaires simplifié</li>
        <li>📧 Intégration native de PHPMailer pour l'envoi d'e-mails</li>
        <li>🌐 Structure publique/privée claire (dossier <code>public/</code> et <code>private/</code>)</li>
        <li>🔑 Chargement automatique des variables d'environnement via <code>EnvLoader</code></li>
        <li>📁 Fichier centralisé pour les constantes (liens, URLs, chemins, etc.) pour éviter les duplications</li>
        <li>📝 Système d’enregistrement des logs d’erreurs pour faciliter le debug</li>
    </ul>

    <h2>Navigation et URL</h2>
    <p>
        Les constantes de navigation sont définies dans <code>constantes.php</code> :
    </p>
    <pre><code>// url.php
define('URL_ACCUEIL', '?url=accueil');
define('URL_CONTACT', '?url=contact');</code></pre>
    <p>
        Elles sont utilisées dans les liens comme ceci :
    </p>
    <pre><code>&lt;li&gt;&lt;a href="&lt;?php echo URL_ACCUEIL; ?&gt;"&gt;Accueil&lt;/a&gt;&lt;/li&gt;
&lt;li&gt;&lt;a href="&lt;?php echo URL_CONTACT; ?&gt;"&gt;Contact&lt;/a&gt;&lt;/li&gt;</code></pre>

    <h2>Fichier des constantes globales</h2>
    <p>
        Pour éviter les duplications et centraliser toutes les références importantes, un fichier spécifique regroupe
        toutes les constantes utilisées dans le projet :
    </p>
    <ul>
        <li>🔗 <strong>Liens externes</strong> : URL de Google, Facebook, Instagram, GitHub, etc.</li>
        <li>🌐 <strong>Liens internes</strong> : URL des pages définies comme constantes (ex : <code>URL_ACCUEIL</code>,
            <code>URL_CONTACT</code>)
        </li>
        <li>🖼️ <strong>Assets</strong> : chemins vers les logos, favicons, images génériques, etc.</li>
        <li>🎨 <strong>Styles communs</strong> : couleurs, dimensions, classes CSS globales si besoin</li>
    </ul>
    <p>
        Exemple de déclaration dans <code>/core/constantes.php</code> :
    </p>
    <pre><code>// Liens externes
define('URL_FACEBOOK', 'https://facebook.com/monprojet');
define('URL_GOOGLE', 'https://google.com');

// Liens internes
define('URL_ACCUEIL', '?url=accueil');
define('URL_CONTACT', '?url=contact');

// Chemins des assets
define('IMG_LOGO', 'public/img/logo.png');
define('IMG_FAVICON', 'public/img/favicon.ico');</code></pre>
    <p>
        Il est recommandé d'inclure ce fichier très tôt dans le <code>index.php</code> principal, avant tout traitement
        :
    </p>
    <pre><code>require_once __DIR__ . '/../config/constantes.php';</code></pre>

    <h2>Fonctionnement global</h2>
    <ul>
        <li>Les URLs sont gérées via le paramètre <code>?url=chemin</code>.</li>
        <li>Le routeur (ControlRoute) analyse cette URL et charge la vue correspondante.</li>
        <li>Chaque page est découpée en template : <code>header.php</code>, <code>navbar.php</code>, la vue spécifique,
            puis <code>footer.php</code>.</li>
        <li>Les vues sont dans <code>core/src/view/</code>.</li>
    </ul>

    <h2>Configuration du fichier <code>.env</code></h2>
    <div style="border: 1px solid #cc0000; background-color: #fff0f0; padding: 15px; border-radius: 5px;">
        <strong>⚠️ Important :</strong> Le fichier <code>.env</code> doit impérativement être configuré pour que
        l'application fonctionne correctement, notamment pour la base de données et l'envoi d'e-mails.
    </div>
    <ol>
        <li>Ouvrez le fichier <code>.env</code> et remplissez les informations nécessaires :</li>
    </ol>
    <pre><code># Base de données
DB_HOST=localhost
DB_NAME=pepinphp
DB_USER=root
DB_PASSWORD=root</code></pre>

    <h2>Ajouter une nouvelle page</h2>
    <p>Pour ajouter une nouvelle page accessible via l'URL <code>?url=nouvellepage</code>, suivez ces étapes :</p>
    <ol>
        <li>Créez la vue correspondante dans le dossier adéquat, par exemple :
            <code>/src/view/navigation/nouvellepage.php</code>.
        </li>
        <li>Ajoutez une entrée dans le switch du routeur <code>ControlRoute</code> dans la méthode <code>route()</code>
            :
            <pre><code>case 'nouvellepage':
    $page = '/src/view/navigation/nouvellepage.php';
    break;</code></pre>
        </li>
        <li>Ajoutez le nom de la page dans le fichier <code>constantes.php</code> :
            <pre><code>define('URL_NOUVELLEPAGE', '?url=nouvellepage');</code></pre>
        </li>
        <li>Vous pouvez ensuite accéder à cette page via <code>http://votre-site/?url=nouvellepage</code> et/ou utiliser
            l'url rewhrite via l'htaccess.</li>
    </ol>

    <h2>Structure recommandée</h2>
    <ul>
        <li><code>/src/view/navigation/</code> pour les pages principales (accueil, contact, etc.)</li>
        <li><code>/src/view/include/</code> pour les sections à importer</li>
        <li><code>/src/view/form/</code> pour les formulaires</li>
    </ul>

    <h2>Support et contribution</h2>
    <p>
        Ce framework est open source et évolutif. N'hésitez pas à proposer des améliorations
        ou à signaler des bugs sur le dépôt GitHub :
        <br>
        🔗 <a href="https://github.com/WebSiteMaker24" target="_blank">github.com/WebSiteMaker24</a> </br>
        🐙 <span onclick="copyCloneCommand()" style="cursor: pointer; color: #0366d6; text-decoration: underline;">
            git clone https://github.com/WebSiteMaker24/PepinPHPv4.git
        </span>
    </p>

    <script>
        function copyCloneCommand() {
            const text = 'git clone https://github.com/WebSiteMaker24/PepinPHPv4.git';
            navigator.clipboard.writeText(text)
                .then(() => alert('✅ Commande copiée dans le presse-papiers'))
                .catch(() => alert('❌ Erreur lors de la copie'));
        }
    </script>
</div>
