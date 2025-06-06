<?php
require __DIR__ . '/Autoload.php';
define('SMTP_PASSWORD', getenv('SMTP_PASSWORD'));

use module\newsletter\ControlNewsletter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/phpmailer/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer.php';
require __DIR__ . '/phpmailer/SMTP.php';
require __DIR__ . '/constantes.php';

$controlNewsletter = new ControlNewsletter();


// Récupération et nettoyage des données POST
$name = trim($_POST['name'] ?? '');
$name = preg_replace("/[^a-zA-Z0-9 .'-]/", '', $name);

$email = trim($_POST['email'] ?? '');

$message = trim($_POST['message'] ?? '');

$token = trim($_POST['csrf_token'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    $_SESSION['message_error'] = "Tous les champs sont obligatoires.";
    header("Location:" . URL_CONTACT);
    exit;
}

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = COMPANY_EMAIL;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom(COMPANY_EMAIL, $name);
    $mail->addAddress(COMPANY_EMAIL, COMPANY_NAME);
    $mail->isHTML(true);
    $mail->Subject = "Nouveau message via aidedomicilecherbourg.fr";

    $template_mail = $_POST["action"] ?? "";

    switch ($template_mail) {
        case "contact_form":
            // On récupère le contenu du template dans une variable tampon
            ob_start();
            require __DIR__ . "/template_mail/contact_form.php";
            $mailBody = ob_get_clean();

            $mail->Body = $mailBody;
            $mail->send();

            $_SESSION['message_success'] = "Merci pour votre message. Nous vous contacterons très bientôt.";
            header("Location:" . URL_CONTACT);
            exit;
        // Confirme pas un mail, l'inscription à la newsletter
        case "newsletter":
            ob_start();

            $confirmationLink = $controlNewsletter->subscribeValidation($email);
            $unsubscribeLink = $controlNewsletter->unsubscribeValidation($email);

            require __DIR__ . "/template_mail/newsletter_confirm.php";
            $mailBody = ob_get_clean();


            $mail->Body = $mailBody;
            $mail->send();
            $_SESSION['message_success'] = "Confirmez votre inscription.";
            header("Location:" . URL_CONFIRM);
            exit;

        default:
            echo "Action non reconnue.";
            exit;
    }


} catch (Exception $e) {
    echo "Erreur d'envoi : {$mail->ErrorInfo}";
}