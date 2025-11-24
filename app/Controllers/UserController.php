<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Gère l'inscription
     */
    public function register()
    {
        // Si le formulaire est soumis
        if (is_post()) {
            $login = post('login');
            $password = post('password');
            $email = post('email');
            $nom = post('nom');
            $prenom = post('prenom');

            //TODO ICI AJOUTER VERIFICATIONS CHAMPS VIDE...

            $userModel = new User();
            //Vérifier si le login est déja pris
            if ($userModel->exists($login)) {
                echo "Ce login est déja pris !";
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            header("Location: /login");
            exit;
        }

        $this->render('auth/register');
    }

    /**
     * Gère la connexion
     */
    public function login()
    {
        if (is_post()) {
            $login = post('login');
            $password = post('password');

            $userModel = new User();

            // On cherche l'utilisateur en base de données
            $user = $userModel->findByLogin($login);

            // Si l'utilisateur existe et que le mot de passe correspond
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                // Connexion réussi on remplit la session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'login' => $login['login'],
                    'nom' => $user['nom']
                ];

                header("Location: /game");
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }

        $this->render('auth/login');
    }

    /**
     * Gère la déconnexion
     */
    public function logout()
    {
        session_destroy();

        header("Location: /");
        exit();
    }
}
