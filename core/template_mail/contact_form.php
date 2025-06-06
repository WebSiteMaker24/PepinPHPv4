<div style="width: 100%; background-color: #0097B1; padding: 40px 0; font-family: 'Poppins', sans-serif;">
    <div
        style="max-width: 600px; margin: auto; background-color: #FFFFFF; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">

        <!-- En-tête -->
        <div style="background-color: #83CCD9; color: #111111; padding: 20px;">
            <h1 style="margin: 0; font-size: 26px;"><?= COMPANY_NAME ?></h1>
            <p style="margin: 5px 0 0; font-weight: 500;">Accompagnante de vie sur Cherbourg</p>
        </div>

        <!-- Contenu principal -->
        <div style="padding: 20px; color: #111111;">
            <h2 style="color: #0097B1; font-size: 1.4em;">📬 Nouveau message
                reçu
            </h2>
            <p style="font-size: 1.1em;"><strong>👤 Nom :</strong> <?= htmlspecialchars_decode($name) ?></p>
            <p style="font-size: 1.1em;"><strong>📧 Email :</strong>
                <a href="mailto:<?= htmlspecialchars_decode($email) ?>"
                    style="color: #0097B1;"><?= htmlspecialchars_decode($email) ?></a>
            </p>
            <p style="font-size: 1.1em;"><strong>📝 Message
                    :</strong><br><?= nl2br(htmlspecialchars_decode($message)) ?></p>
        </div>

        <!-- Pied -->
        <div style="background-color: #FBEFE6; padding: 15px 20px; font-size: 13px; color: #111111;">
            <p style="margin: 10px 0;">📍 <?= COMPANY_ADDRESS ?></p>
            <p style="margin: 10px 0;">📞
                <a href="tel:<?= COMPANY_PHONE_LINK ?>" style="color: #0097B1;"><?= COMPANY_PHONE ?></a>
            </p>
            <p style="margin: 10px 0;">📧
                <a href="mailto:<?= COMPANY_EMAIL ?>" style="color: #0097B1;"><?= COMPANY_EMAIL ?></a>
            </p>
        </div>
    </div>

    <!-- Footer global -->
    <p style="text-align: center; font-size: 12px; color: #FFFFFF; margin-top: 20px;">
        Ce message a été généré automatiquement depuis
        <strong style="color: #FBEFE6;"><?= COMPANY_NAME ?>.fr</strong>
    </p>
</div>