<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    /**
     * Return all the Users from the database
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
                    ->setIsAdmin((bool)$userData['is_admin'])
                ;
            }
        }

        return $users;
    }

    public function isAdmin(User $user): bool {
        if ($user->isAdmin()) {
            // if $is_admin property of the object User is true,
            // then we return true without asking the database
            return true;
        } else {
            if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
                $id = $_SESSION['user']['id_user']; // get ID from the session
                $userConnected = $this->getUserById($id);
                if ($userConnected && $userConnected->isAdmin()) {
                    // if the user is admin in database
                    // then we update $is_admin property of the User object
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
                    ->setPseudo($userData['pseudo'])
                    ->setIsAdmin((bool)$userData['is_admin'])
                    ;
            }
        }
        return null;
    }

    public function deleteUserById(int $id): bool
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
