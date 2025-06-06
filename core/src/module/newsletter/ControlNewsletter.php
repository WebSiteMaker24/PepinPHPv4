<?php

namespace module\newsletter;

use module\newsletter\ModelNewsletter;

class ControlNewsletter
{
    private ModelNewsletter $_model;

    public function __construct()
    {
        $this->_model = new ModelNewsletter(); // Singleton
    }
    public function subscribe(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message_error'] = 'Adresse email invalide.';
            exit;
        }

        if ($this->_model->exists($email)) {
            $_SESSION['message_error'] = 'Adresse déjà inscrite.';
            exit;
        }

        try {
            $this->_model->insert($email);
            $_SESSION['message_success'] = 'Inscription réussie.';
        } catch (\PDOException $e) {
            $_SESSION['message_error'] = 'Erreur lors de l\'inscription.';
            exit;
        }
    }

    public function unsubscribe(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message_error'] = 'Adresse email invalide.';
            exit;
        }

        if (!$this->_model->exists($email)) {
            $_SESSION['message_error'] = 'Adresse non trouvée.';
            exit;
        }

        try {
            $this->_model->unsubscribe($email);
            $_SESSION['message_success'] = 'Désinscription réussie.';
        } catch (\PDOException $e) {
            $_SESSION['message_error'] = 'Erreur lors de la désinscription.';
            exit;
        }
    }


    public function listSubscribers(): array
    {
        try {
            return $this->_model->getAll();
        } catch (\PDOException $e) {
            return [];
        }
    }
    // Methode a test 
    public function subscribeValidation(string $email): bool
    {
        // Ici tu peux ajouter des validations supplémentaires si besoin
        return $this->_model->subscribe($email);
    }

    /**
     * Désinscrire un email de la newsletter
     */
    public function unsubscribeValidation(string $email): bool
    {
        // Validation ou vérification complémentaire possible ici
        return $this->_model->unsubscribe($email);
    }
}