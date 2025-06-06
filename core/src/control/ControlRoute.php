<?php
namespace control;
class ControlRoute
{
    private string $_url;

    public function __construct(string $url)
    {
        $this->_url = trim($url, '/');
    }

    public function route(): void
    {
        $basePath = dirname(__DIR__, 2);
        $page = "";
        $keyword = "";
        $description = "";
        $canonical = "";
        $title = "";

        // Liste des pages autorisées
        $routes_valides = ["", "accueil", "contact", "404"];
        if (!in_array($this->_url, $routes_valides)) {
            $this->_url = (string) "404";
        }


        switch ($this->_url) {
            case "":
                $url = $this->_url;
                $robot = "index, follow";
                $canonical = "";
                $description = "";
                $keyword = "";
                $title = "PepinPHP - Votre Framework PHP Simple et Léger";
                $css = "public/css/style.css";
                $h1 = "PepinPHP - Votre Framework PHP Simple et Léger";
                $page = "/src/view/navigation/accueil.php";
                break;

            /* LA NAVIGATION */
            case "accueil":
                $url = $this->_url;
                $robot = "index, follow";
                $canonical = "";
                $description = "";
                $keyword = "";
                $title = "PepinPHP - Votre Framework PHP Simple et Léger";
                $css = "public/css/style.css";
                $h1 = "PepinPHP - Votre Framework PHP Simple et Léger";
                $page = "/src/view/navigation/accueil.php";
                break;

            case "contact":
                $url = $this->_url;
                $robot = "index, follow";
                $canonical = "";
                $description = "";
                $keyword = "";
                $title = "PepinPHP - Votre Framework PHP Simple et Léger";
                $css = "public/css/style.css";
                $h1 = "PepinPHP - Votre Framework PHP Simple et Léger";
                $page = "/src/view/navigation/contact.php";
                break;

            default:  // 404
                $robot = "noindex, nofollow";
                $keyword = "erreur 404, page non trouvée, PepinPHP";
                $description = "La page demandée n'existe pas ou a été déplacée.";
                $canonical = "";
                $title = "Erreur 404 - Page non trouvée";
                $page = '/src/view/navigation/404.php';
                break;
        }

        // Template public
        $route_template_public = '/src/view/template/';
        require_once $basePath . $route_template_public . 'header.php';
        require_once $basePath . $route_template_public . 'navbar.php';
        require_once $basePath . $page;
        require_once $basePath . $route_template_public . 'footer.php';
        // Template admin (par exemple)
        // $route_template_admin = '/src/view/admin/';
        // require_once $basePath . $route_template_admin . 'header.php';
        // require_once $basePath . $route_template_admin . 'navbar.php';
        // require_once $basePath . $page;
        // require_once $basePath . $route_template_admin . 'footer.php';
    }

    private function ipAutorisee(): bool
    {
        $ips_autorisees = explode(',', getenv('ADMIN_IP'));

        $ip_client = $_SERVER['REMOTE_ADDR'];
        return in_array($ip_client, $ips_autorisees);
    }
}