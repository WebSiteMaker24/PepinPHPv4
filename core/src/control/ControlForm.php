<?php

namespace control;

use csrf\CSRFProtection;
use module\newsletter\ControlNewsletter;

class ControlForm
{
    private CSRFProtection $csrfProtection;
    private ControlNewsletter $controlNewsletter;
    private string $logFile = __DIR__ . '/../log/form-errors.log';

    public function __construct(CSRFProtection $csrfProtection, ControlNewsletter $controlNewsletter)
    {
        $this->csrfProtection = $csrfProtection;
        $this->controlNewsletter = $controlNewsletter;
    }

    public function handleRequest(): void
    {
        $form = $_POST['action'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si le token crsf n'est pas valide
            if (!isset($_POST['csrf_token']) || !$this->csrfProtection->validateToken($_POST['csrf_token'])) {
                $_SESSION['message_error'] = 'Erreur : Token CSRF invalide !';
                $this->logError();
                exit;
            }
            // Si le token crsf est valide
            $email = $_POST['email'] ?? null;

            // Action valide
            $validForms = ['newsletter', 'contact_form', 'newsletter_confirm', 'log'];
            if (!in_array($form, $validForms)) {
                header("Location:" . URL_ACCUEIL);
                exit;
            }

            switch ($form) {
                case 'newsletter':
                    $this->handlerNewsletter($email);
                    require_once __DIR__ . "/../../sendmail.php";
                    break;
                case 'contact_form':
                    require_once __DIR__ . "/../../sendmail.php";
                    break;
                case 'newsletter_confirm':
                    require_once __DIR__ . "/../../sendmail.php";
                    break;
                case 'log':
                    // $visitControl = new \module\comptevisit\ControlVisit();
                    break;
                default:
                    $_SESSION['message_error'] = 'Erreur : Formulaire invalide !';
                    break;
            }
        }
    }
    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    public function logError()
    {
        $log = "[" . date('Y-m-d H:i:s') . "] Tentative CSRF - IP : " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        error_log($log, 3, $this->logFile);
    }
    public function handlerNewsletter($email): void
    {
        if ($email === null || empty(trim($email))) {
            $_SESSION['message_info'] = "L'adresse email est requise.";
            exit;
        }

        if (!$this->isValidEmail($email)) {
            $_SESSION['message_info'] = "L'adresse email n'est pas valide.";
            exit;
        }
        if (
            $this->controlNewsletter->subscribe($email)
        ) {
            $_SESSION["message_success"] = "Votre inscription a bien été prise en compte. Veuillez vérifier votre boîte mail pour confirmer votre abonnement.";
        } else {
            $_SESSION["message_error"] = "Une erreur est survenue lors de l'inscription. Merci de réessayer plus tard.";
        }
    }
}