<?php

namespace App\Controller;

use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * Users listing
     * @return void
     */
    public function index()
    {
        $manager = new UserManager();
        $users = $manager->getAll();

        $message = isset($_GET['message']) ? $_GET['message'] : null;

        $this->display('user/listing', [
            'users' => $users,
            'message' => $message
        ]);
    }

    public function delete($id)
    {
        $manager = new UserManager();
        $deleted = $manager->deleteUserById($id);

        if ($deleted) {
            $message = "L'utilisateur a été supprimé avec succès.";
        } else {
            $message = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
        }

        // Redirect to user listing with the message
        header("Location: /user?message=" . urlencode($message));
        exit();
    }

}
