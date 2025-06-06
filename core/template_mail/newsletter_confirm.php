<!-- Contenu principal -->
<div style="padding: 20px; color: #111;">
    <h2 style="color: #009C86; font-size: 1.2em;">Confirmez votre inscription à notre newsletter</h2>
    <p style="font-size: 1.1em;">
        Bonjour,<br><br>
        Merci de votre intérêt pour notre newsletter !<br>
        Pour finaliser votre inscription et recevoir nos actualités, veuillez confirmer votre adresse email en
        cliquant sur le lien ci-dessous :<br><br>
        <a href="<?php echo $confirmationLink ?? '#'; ?>"
            style="display: inline-block; background-color: #009C86; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 600;">
            Confirmer mon inscription
        </a><br><br>
        Si vous n'avez pas demandé cette inscription, ignorez simplement ce message.<br><br>
        À très bientôt,<br>
        L'équipe <?php echo COMPANY_NAME; ?>
    </p>

    <!-- Lien de désabonnement -->
    <p style="font-size: 12px; color: #666; text-align: center; margin-top: 20px;">
        Si vous souhaitez vous désabonner de cette newsletter, cliquez ici :
        <a href="<?php echo $unsubscribeLink; ?>" style="color: #009C86; text-decoration: underline;">Se désabonner</a>
    </p>
</div>