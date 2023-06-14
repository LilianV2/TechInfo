<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Cart;

class CartManager
{
    public function getCartByIdUser(): array
    {
        if (isset($_SESSION['connected']) && $_SESSION['connected']) {
            $user_id = $_SESSION["user"]["id_user"];
        }
        $sql = "SELECT * FROM cart WHERE user_id = :id";
        $stmt = DB::getInstance()->prepare($sql);

        $stmt->bindParam(':id', $user_id);
        $carts = [];
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            foreach ($data as $cartData) {
                $author = (new UserManager())->getUserById($cartData['user_id']);
                $cart = (new Cart())
                    ->setId($cartData['id'])
                    ->setTitle($cartData['title'])
                    ->setPrice($cartData['price'])
                    ->setAuthor($author);
                $carts[] = $cart;
            }
        }
        return $carts;
    }
}