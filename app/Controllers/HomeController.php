<?php

namespace App\Controllers;

use Core\BaseController;

/**
 * Classe HomeController
 * ----------------------
 * Contrôleur responsable de la gestion de la page d'accueil.
 * Hérite de BaseController afin de bénéficier des méthodes utilitaires
 * comme render() pour afficher les vues.
 */
class HomeController extends BaseController
{
    /**
     * Action principale (point d'entrée de la page d'accueil)
     *
     * @return void
     */
    public function index(): void
    {
        // Appelle la méthode render() de BaseController
        // - Charge la vue "app/Views/home/index.php"
        // - Injecte le tableau de paramètres (ici, une variable $title utilisable dans la vue)
        // - Insère le contenu de la vue dans le layout global "base.php"
        // Charger la configuration des thèmes
        $themes = require __DIR__ . '/../config/themes.php';
        $selectedTheme = $_SESSION['theme'] ?? 'savane';

        // Injecter les variables nécessaires à la vue
        $this->render('home/index', [
            'title' => 'Bienvenue sur le mini-MVC',
            'themes' => $themes,
            'selectedTheme' => $selectedTheme
        ]);
    }

    public function about(): void
    {
        $this->render('home/about', [
            'title' => "À propos de nous !!"
        ]);
    }

    public function galerie(): void
    {
        $this->render('home/galerie', [
            'title' => "Galerie des Cartes - Memory Savane"
        ]);
    }

    /**
     * Action pour changer le thème via le formulaire
     */
    public function theme(): void
    {
        if (isset($_POST['theme'])) {
            $theme = $_POST['theme'];
            $_SESSION['theme'] = $theme;
            // Charger la configuration des thèmes
            $themes = require __DIR__ . '/../config/themes.php';
            if (isset($themes[$theme])) {
                $_SESSION['theme_config'] = $themes[$theme];
            }
        }
        // Redirection vers l'accueil après le choix
        header('Location: /');
        exit;
    }
}
