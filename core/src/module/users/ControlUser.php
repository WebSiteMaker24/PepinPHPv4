<?php

namespace module\users;

class ControlUser
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function createUser(string $email, string $password, string $ip, string $userAgent): string
    {
        if (!$this->isValidEmail($email)) {
            return "Email invalide.";
        }

        if ($this->userModel->emailExists($email)) {
            return "L'email est déjà utilisé.";
        }

        if (!$this->isValidPassword($password)) {
            return "Mot de passe invalide.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->userModel->create([
            'email' => $email,
            'mot_de_passe' => $hashedPassword,
            'adresse_ip' => $ip,
            'referer_url' => $userAgent,
            'accepte_cgu' => true,
            'email_valide' => false,
            'provider' => 'local',
            'actif' => true,
        ]);

        return "Utilisateur créé avec succès.";
    }

    public function loginUser(string $email, string $password): array|string
    {
        if (!$this->isValidEmail($email)) {
            return "Email invalide.";
        }

        $user = $this->userModel->login($email, $password);

        return $user ?: "Identifiants incorrects.";
    }

    public function updateUser(int $id, string $email, string $password, string $status): string
    {
        if (!$this->isValidEmail($email)) {
            return "Email invalide.";
        }

        if (!$this->isValidPassword($password)) {
            return "Mot de passe invalide.";
        }

        $data = [
            'email' => $email,
            'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT),
            'actif' => ($status === '1' ? 1 : 0),
        ];

        $this->userModel->update($id, $data);

        return "Utilisateur mis à jour.";
    }

    public function deleteUser(int $id): string
    {
        $this->userModel->delete($id);
        return "Utilisateur supprimé.";
    }

    private function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isValidPassword(string $password): bool
    {
        return strlen($password) >= 8;
    }
}