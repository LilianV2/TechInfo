<?php

use App\Model\Manager\UserManager;

$user = new \App\Model\Entity\User();
$userManager = new UserManager();
$userIsAdmin = $userManager->isAdmin($user);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/articles">Composants</a></li>
            <?php if ($user->isAdmin()) : ?>
                <li><a href="/user">Admin</a></li>
            <?php endif; ?>
            <li><a href="/home" id="title">Tech'Info</a></li>
            <li><a href="/article">Commentaires</a></li>
            <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"]) : ?>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/login">Se connecter</a></li>
            <?php endif; ?>
            <li id="burger-icon"><i class="fa-solid fa-bars"></i></li>
        </ul>
    </nav>
    <div class="burger-menu">
        <div class="burger-body">
            <i class="fa-solid fa-xmark" id="close-burger-icon"></i>
            <ul>
                <li><a href="/home">Home</a></li>
                <li><a href="/articles">Composants</a></li>
                <?php if ($user->isAdmin()) : ?>
                    <li><a href="/user">Admin</a></li>
                <?php endif; ?>
                <li><a href="/article">Commentaires</a></li>
                <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"]) : ?>
                    <li><a href="/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/login">Se connecter</a></li>
                <?php endif; ?>
                <li><i class="fa-solid fa-bars"></i></li>
            </ul>
        </div>
    </div>
</header>


     <section class="main">
         <?= $html ?>
     </section>

<footer>

</footer>

<script src="/assets/js/app.js"></script>
</body>
</html>
