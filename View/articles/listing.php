<?php

use App\Model\Manager\UserManager;
$user = new \App\Model\Entity\User();
$userManager = new UserManager();
$userIsAdmin = $userManager->isAdmin($user);

?>

<div class="comment">

    <section class="home-contact">
        <div class="home-info">
            <h1>Laissez un commentaire !</h1>
            <p>
                Votre opinion compte ! Rejoignez la conversation en laissant un commentaire
                et partagez votre expérience. Nous sommes impatients de connaître votre point de vue !
            </p>
            <button id="create-article-btn">Publier un article</button>
        </div>
        <form action="/articles/createArticles" class="create-article" method="post">
            <label for="title">Sujet de l'article</label>
            <input type="text" name="title" id="title">
            <hr>
            <label for="content">Contenu</label>
            <textarea name="content" id="content" placeholder="A vos clavier !" rows='7' data-min-rows='7'></textarea>
            <input type="submit" value="Valider mon article" class="send-article" name="create_content">
            <button id="close-btn">Fermer</button>
        </form>
    </section>

    <section class="article-container">
        <?php
        foreach ($params['article'] as $article) {
            /* @var User $user */ ?>

                <div class="article-content">
                    <h1><?= $article->getTitle() ?></h1>
                    <hr>
                    <p><?= $article->getContent() ?></p>
                    <p class="smallcaps">Publié par <span class="italic"><?= $article->getAuthor()->getPseudo() ?></span>
                    </p>
                    <hr>
                    <?php if ($user->isAdmin()) : ?>
                    <a href="/articles/view/<?= $article->getId() ?>" class="modify">Modifier l'article</a>
                    <a href="/articles/delete/<?= $article->getId() ?>" class="delete">Supprimer l'article</a>
                    <?php endif; ?>
                </div>

            <?php
        } ?>
    </section>
</div>

