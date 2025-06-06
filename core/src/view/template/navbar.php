<style>
    nav {
        width: 100%;
        position: sticky;
        top: 0;
        left: 0;
        right: 0;
        background: var(--color-primary-strong);
        z-index: 999;
    }

    nav ul {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    nav ul li {
        padding: 0;
        margin: 0;
    }

    nav ul li.logo {
        margin-right: auto;
        padding-left: 20px;
    }

    nav ul li.logo img {
        height: 50px;
        display: block;
    }

    nav ul li a {
        padding: 15px 25px;
        display: block;
        font-weight: bold;
        color: white;
        text-decoration: none;
    }
</style>
<nav>
    <ul>
        <li class="logo">
            <a href="<?= URL_ACCUEIL; ?>">
                <img src="<?= IMG_LOGO; ?>" alt="PepinPHP Logo" class="logo">
            </a>
        </li>
        <li><a href="<?= URL_ACCUEIL; ?>">Accueil</a></li>
        <li><a href="<?= URL_CONTACT; ?>">Contact</a></li>
    </ul>
</nav>