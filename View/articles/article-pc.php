<?php
use App\Model\Entity\ArticlePc;
?>

<section class="article-container">
    <!--
    <div class="top-articles">
        <div>
            <h1>Meilleures ventes</h1>
        </div>
        <hr>
        <div class="flex-card">
            <div class="small-card"></div>
            <div class="small-card"></div>
            <div class="small-card"></div>
        </div>
    </div>
    -->
    <?php
    foreach ($params['articles'] as $article) {
        /* @var ArticlePc $article */
        ?>
        <div>
            <div class="article-content">
                <h1><?= $article->getName() ?? 'Nom non disponible' ?></h1>
                <hr>
                <p>(image)</p>
                <hr>

                <p>Prix : <?= $article->getPrice() ?> €</p>

                <hr>

                <a href="/cart/addToCart/<?= $article->getId() ?>">Ajouter à la sélection</a>

            </div>
        </div>
        <?php
    } ?>
    <div class="cart">
        <a href="/cart" id="cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
        <div class="count">12</div>
    </div>
</section>

