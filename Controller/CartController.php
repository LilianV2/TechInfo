<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\UserManager;


class CartController extends AbstractController
{
    public function addToCart($id)
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            $article_id = $id; // Id clicked on

            $sql2 = "SELECT * FROM articles WHERE id = :article_id";
            $req2 = DB::getInstance()->prepare($sql2);

            $req2->bindParam(':article_id', $article_id);

            if ($req2->execute()) {
                $userData = $req2->fetch();// Turn our $req into an associative array

                if ($userData && isset($userData['title'])) {
                    $price = $userData['price'];
                    $title = $userData['title'];

                    $user_id = $_SESSION["user"]['id_user'];// Connected client ID

                    $sql = "INSERT INTO cart (title, price, user_id) VALUES (:title, :price, :user_id)";
                    $req = DB::getInstance()->prepare($sql);

                    $req->bindParam(':title', $title); // Get the title
                    $req->bindParam(':price', $price); // Get the price
                    $req->bindParam(':user_id', $user_id);

                    $req->execute();
                    header('Location: /home');
                    exit; // Add an exit statement after the header redirection
                }
            }
        } else {
            $this->display("login/login");
        }
    }

    public function removeToCart($id)
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            $article_id = $id;

            $sql = "DELETE FROM cart WHERE id = :articles_id";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':article_id', $article_id);

            $req->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $this->display("login/login");
        }
    }
}