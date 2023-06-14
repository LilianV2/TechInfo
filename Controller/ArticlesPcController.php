<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\ArticlePcManager;
use App\Model\Manager\UserManager;

class ArticlesPcController extends AbstractController
{
    public function index()
    {
        $manager = new ArticlePcManager();
        $this->display('articles/article-pc', [
            'articles' => $manager->getAll()
        ]);
    }

    public function cart()
    {
        $manager = new ArticlePcManager();
        // Vérifie si la variable de session "cart" existe
        if (isset($_SESSION['cart'])) {
            // Récupère les articles sélectionnés à partir de la variable de session
            $selectedArticles = $_SESSION['cart'];
        } else {
            // Aucun article sélectionné pour le moment
            $selectedArticles = [];
        }

        if (isset($_GET['add'])) {
            $articleId = $_GET['add'];

            // Vérifie si l'article existe et n'est pas déjà dans la sélection
            $article = $manager->getArticleById($articleId);
            if ($article && !in_array($article, $selectedArticles)) {
                // Ajoute l'article à la sélection
                $selectedArticles[] = $article;
                // Met à jour la variable de session avec les articles sélectionnés
                $_SESSION['cart'] = $selectedArticles;
            }
        }
        if (isset($_GET['remove'])) {
            $articleId = $_GET['remove'];

            // Recherche l'indice de l'article à supprimer dans le tableau des articles sélectionnés
            $index = array_search($articleId, array_column($selectedArticles, 'id'));

            // Vérifie si l'article a été trouvé dans la sélection
            if ($index !== false) {
                // Supprime l'article de la sélection en utilisant l'indice trouvé
                unset($selectedArticles[$index]);
                // Réorganise les indices du tableau
                $selectedArticles = array_values($selectedArticles);
                // Met à jour la variable de session avec les articles restants
                $_SESSION['cart'] = $selectedArticles;
            }
            // Redirige vers la page du panier
            header('Location: /cart');
            return;

        }

        $this->display('articles/cart', [
            'selectedArticles' => $selectedArticles
        ]);
    }
}