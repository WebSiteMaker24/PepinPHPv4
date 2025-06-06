<!DOCTYPE html>
<html lang="fr">

<!-- site toujours en developpement, bonne visite ! -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="alternate" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>" hreflang="fr">

    <meta name="description" content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keyword" content="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>">

    <meta name="author" content="<?= COMPANY_NAME; ?>">
    <meta name="email" content="<?= COMPANY_EMAIL; ?>">
    <meta name="address" content="<?= COMPANY_ADDRESS; ?>">
    <meta name="robots" content="<?= htmlspecialchars($robot, ENT_QUOTES, 'UTF-8'); ?>">

    <meta name="geo.placename" content="<?= GEO_PLACENAME; ?>">
    <meta name="geo.region" content="<?= GEO_REGION; ?>">
    <meta name="geo.position" content="<?= GEO_POSITION; ?>">

    <meta property="og:description" content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:title" content="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= IMG_OG; ?>">
    <meta property="og:locale" content="fr">

    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>

    <link rel="stylesheet" href="public/css/style.css">

    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body>