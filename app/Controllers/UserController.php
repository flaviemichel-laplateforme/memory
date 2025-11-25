<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;
use App\Models\Score;

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
            // var_dump($_POST);
            // exit;


            //TODO ICI AJOUTER VERIFICATIONS CHAMPS VIDE...
            //Validation des champs
            if (empty($login) || empty($password) || empty($email) || empty($nom) || empty($prenom)) {
                set_flash('error', 'Tous les champs sont obigatoires');
                $this->render('auth/register');
                return;
            }

            //Validation des emails
            if (!validate_email($email)) {
                set_flash('error', 'Email invalide');
                $this->render('auth/register');
                return;
            }

            //Validation longueur du mot de passe
            if (strlen($password) < 6) {
                set_flash('error', 'Le mot de passe doit contenir au moins 6 caractères');
                $this->render('auth/register');
                return;
            }


            $userModel = new User();

            //Vérifier si le login est déja pris
            if ($userModel->exists($login)) {
                set_flash('error', 'Ce login est déja pris !');
                $this->render('auth/register');
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userModel->create($login, $hashedPassword, $email, $nom, $prenom);

            set_flash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
            header("Location: /auth/login");
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
            if ($user && password_verify($password, $user['password'])) {
                // Connexion réussi on remplit la session
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'login' => $user['login'],
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
        // Vider toutes les variables de session
        $_SESSION = [];

        // Détruire complètement la session
        session_destroy();

        // Redémarrer une nouvelle session pour le message flash
        session_start();
        set_flash('success', 'Vous êtes déconnecté avec succès');

        // Redirection vers la page d'accueil
        header("Location: /");
        exit();

        // Redirection vers la page d'accueil
        header("Location: /");
        exit();
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $userModel = new User();
        $scoreModel = new Score();
        $message = null;

        if (is_post()) {
            $login = post('login');
            $email = post('email');
            $nom = post('nom');
            $prenom = post('prenom');
            $password = post('password');

            // Appel au modèle avec TOUS les champs
            $userModel->update($login, $email, $nom, $prenom, $password);

            // Mise à jour de la session (pour que l'affichage reste à jour sans se reconnecter)
            $_SESSION['user']['login'] = $login;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['nom'] = $nom;
            $_SESSION['user']['prenom'] = $prenom;

            set_flash('success', 'Profil mis à jour avec succès !');
        }

        // 3. Récupération des données fraîches de l'utilisateur
        // C'est mieux de récupérer les infos en BDD pour être sûr d'avoir les dernières versions
        $currentUser = $userModel->findById($userId);

        // 4. Récupération stats
        $historique = $scoreModel->getUserHistory($userId);
        $bestScore = $scoreModel->getUserBest($userId);


        // 5. Envoi à la vue (on envoie $currentUser pour pré-remplir les champs)
        $this->render('auth/profile', [
            'user' => $currentUser,
            'historique' => $historique,
            'bestScore' => $bestScore,
            'message' => $message
        ]);
    }
}
