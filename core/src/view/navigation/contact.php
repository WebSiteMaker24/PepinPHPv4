<!-- src/view/navigation/contact.php -->
<style>
    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background: #f7f9fc;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        color: #2c3e50;
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    a {
        color: #3498db;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .info-block {
        background: #ecf0f1;
        padding: 20px;
        border-radius: 6px;
        margin-top: 30px;
    }
</style>

<div class="container">
    <h1>Contactez WebSiteMaker</h1>
    <p>Pour toute question ou suggestion d'amélioration, vous pouvez me contacter via :</p>

    <div class="info-block">
        <p><strong>Email :</strong> <a href="mailto:contact@websitemaker.fr">contact@websitemaker.fr</a></p>
        <p><strong>GitHub :</strong> <a href="https://github.com/WebSiteMaker24" target="_blank"
                rel="noopener noreferrer">https://github.com/WebSiteMaker24</a></p>
    </div>

    <h2 style="margin-top: 40px;">À propos du formulaire de contact</h2>
    <p>
        Un fichier <code>sendmail.php</code> est prévu avec <code>PHPMailer</code> pour envoyer des emails via SMTP.
        Il nécessite une configuration manuelle avec vos infos.
    </p>

    <p>Exemple de configuration :</p>

    <pre style="overflow-x: auto; background: #f4f4f4; padding: 10px; border-radius: 8px;"><code>
define('COMPANY_NAME', 'NomEntreprise');
define('COMPANY_EMAIL', 'votre@mail.com');
define('COMPANY_PHONE', '06 12 34 56 78');
define('COMPANY_PHONE_LINK', '0612345678');
define('COMPANY_ADDRESS', '12345 Ville');
define('SMTP_PASSWORD', 'MotDePasseApp');
</code></pre>

    <p style="font-style: italic; color: #7f8c8d;">
        Créez le mot de passe dans votre console Google si vous utilisez Gmail, avec l’authentification à deux facteurs
        activée.
    </p>
</div>