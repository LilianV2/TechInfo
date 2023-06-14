<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\ArticlePc;

class ArticlePcManager
{

    public function getAll(): array
    {
        $articles = [];
        $sql = "SELECT * FROM articles";
        $request = DB::getInstance()->query($sql);
        if ($request) {
            $data = $request->fetchAll();
            foreach ($data as $articleData) {

                $articles[] = (new ArticlePc())
                    ->setId($articleData['id'])
                    ->setName($articleData['name'])
                    ->setPrice($articleData['price']);

            }
        }

        return $articles;
    }

    public function getArticleById(int $id): ?ArticlePc
    {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            foreach ($data as $articleData) {
                return (new ArticlePc())
                    ->setId($articleData['id'])
                    ->setName($articleData['name'])
                    ->setPrice($articleData['price']);
            }
        }

        return null;
    }
}
