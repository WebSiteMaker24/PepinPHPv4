<?php

namespace control;

class ControlMain
{
    public function __construct()
    {
    }

    // Gère l'affichage des messages (erreur, succes, info)
    public static function message_flash(): string|null
    {
        if (isset($_SESSION["message_success"])) {
            $message = $_SESSION["message_success"];
            unset($_SESSION["message_success"]);
            return '<div class="message-flash success"><i class="fa-regular fa-circle-check"></i>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
        }

        if (isset($_SESSION["message_error"])) {
            $message = $_SESSION["message_error"];
            unset($_SESSION["message_error"]);
            return '<div class="message-flash error"><i class="fa-regular fa-triangle-exclamation"></i>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
        }

        if (isset($_SESSION["message_info"])) {
            $message = $_SESSION["message_info"];
            unset($_SESSION["message_info"]);
            return '<div class="message-flash info"><i class="fa-regular fa-circle-info"></i>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
        }

        return null;
    }
}