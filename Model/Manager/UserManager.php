<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    /**
     * Retourne tous les utilisateurs de la base de données.
     * @return array
     */
    public function getAll(): array
    {
        $users = [];
        $sql = "SELECT * FROM user";
        $request = DB::getInstance()->query($sql);
        if($request) {
            $data = $request->fetchAll();
            foreach ($data as $userData) {
                $users[] = (new User())
                    ->setId($userData['id'])
                    ->setPassword($userData['password'])
                    ->setEmail($userData['email'])
                    ->setPseudo($userData['pseudo'])
                ;
            }
        }

        return $users;
    }

    public function isAdmin(User $user): bool {
        if ($user->isAdmin()) {
            // Si la propriété $is_admin de l'objet User est true,
            // alors on retourne true sans interroger la base de données.
            return true;
        } else {
            if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
                $id = $_SESSION['user']['id_user']; // Récupère l'id depuis la session
                $userConnected = $this->getUserById($id);
                if ($userConnected && $userConnected->isAdmin()) {
                    // Si l'utilisateur a le rôle d'administrateur enregistré en BDD,
                    // alors on met à jour la propriété $is_admin de l'objet User
                    $user->setIsAdmin(true);
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * Return a simple user.
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            $userData = $stmt->fetch();
            if ($userData) {
                return (new User())
                    ->setId((int)$userData['id'])
                    ->setPassword($userData['password'])
                    ->setEmail($userData['email'])
                    ->setPseudo($userData['pseudo']);
            }
        }
        return null;
    }


}
