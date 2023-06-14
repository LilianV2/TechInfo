<?php

namespace App\Controller;

use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * Permet le listing de tous les utilisateurs.
     * @return void
     */
    public function index()
    {
//        $manager = new UserManager();
//
//        // Vérifier si une suppression d'utilisateur a été effectuée
//        if (isset($_GET['delete']) && !empty($_GET['delete'])) {
//            $deleteId = (int)$_GET['delete'];
//            $manager->deleteUserById($deleteId);
//            // Rediriger vers la page du listing des utilisateurs après la suppression
//            header("Location: /user");
//            exit();
//        }
//
//        $this->display('user/listing', [
//            'users' => $manager->getAll()
//        ]);

        $manager = new UserManager();
        $users = $manager->getAll();

        $message = isset($_GET['message']) ? $_GET['message'] : null;

        $this->display('user/listing', [
            'users' => $users,
            'message' => $message
        ]);
    }

//    public function delete($id)
//    {
//        $manager = new UserManager();
//        $user = $manager->getUserById($id);
//
//        if ($user) {
//            // Appeler la méthode de suppression de l'utilisateur dans le UserManager
//            $deleted = $manager->deleteUserById($id);
//
//            if ($deleted) {
//                $message = "L'utilisateur a été supprimé avec succès.";
//                $this->display('user/delete', ['message' => $message]);
//            } else {
//                $message = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
//                $this->display('user/delete', ['message' => $message]);
//            }
//        } else {
//            $message = "L'utilisateur n'existe pas.";
//            $this->display('user/delete', ['message' => $message]);
//        }
//    }

//    public function delete($id)
//    {
//        $manager = new UserManager();
//        $deleted = $manager->deleteUserById($id);
//
//        if ($deleted) {
//            $message = "L'utilisateur a été supprimé avec succès.";
//            $this->display('user/listing', ['message' => $message]);
//        } else {
//            $message = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
//            $this->display('user/listing', ['message' => $message]);
//        }
//    }

    public function delete($id)
    {
        $manager = new UserManager();
        $deleted = $manager->deleteUserById($id);

        if ($deleted) {
            $message = "L'utilisateur a été supprimé avec succès.";
        } else {
            $message = "Une erreur s'est produite lors de la suppression de l'utilisateur.";
        }

        // Rediriger vers la page du listing des utilisateurs avec le message
        header("Location: /user?message=" . urlencode($message));
        exit();
    }

}
