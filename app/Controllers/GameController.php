<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Card;
use Core\Database;
use App\Models\Score;

class GameController extends BaseController
{
    public function abandon()
    {
        // Réinitialise la partie
        unset($_SESSION['jeu']);
        unset($_SESSION['debut_partie']);
        unset($_SESSION['nb_paires']);
        unset($_SESSION['theme']);
        unset($_SESSION['theme_config']);
        header("Location: /game");
        exit();
    }
    public function index()
    {
        if (is_post()) {

            $nbPaires = intval(post('nombre_paires'));
            $theme = post('theme') ?? 'savane';

            // Charger la configuration des thèmes
            $themes = require __DIR__ . '/../config/themes.php';

            // Vérifier que le thème existe
            if (!isset($themes[$theme])) {
                $theme = 'savane';
            }

            $themeConfig = $themes[$theme];
            $themePath = "/assets/images/themes/" . $themeConfig['folder'];

            // Scanner les images du thème
            $cardsDir = __DIR__ . '/../../public/assets/images/themes/' . $themeConfig['folder'];
            $availableCards = [];

            if (is_dir($cardsDir)) {
                $files = scandir($cardsDir);
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                        $availableCards[] = $themePath . '/' . $file;
                    }
                }
            }

            // Si pas assez de cartes, utiliser l'ancien système
            if (count($availableCards) < $nbPaires) {
                $availableCards = [];
                for ($c = 1; $c <= $nbPaires; $c++) {
                    $availableCards[] = "/assets/images/cards/" . $c . ".jpg";
                }
            }

            // Mélanger et prendre seulement le nombre de paires demandé
            shuffle($availableCards);
            $selectedCards = array_slice($availableCards, 0, $nbPaires);

            $deck = [];
            $cardId = 1;

            // Créer les paires
            foreach ($selectedCards as $imagePath) {
                $carte1 = new Card($cardId, $imagePath);
                $carte2 = new Card($cardId, $imagePath);
                $deck[] = $carte1;
                $deck[] = $carte2;
                $cardId++;
            }

            shuffle($deck);
            $_SESSION['jeu'] = $deck;
            $_SESSION['theme'] = $theme;
            $_SESSION['theme_config'] = $themeConfig;

            // --- 🆕 AJOUTS POUR LE SCORE ---
            // On lance le chrono (heure actuelle en secondes)
            $_SESSION['debut_partie'] = time();

            // On retient la difficulté (nombre de paires)
            $_SESSION['nb_paires'] = $nbPaires;

            header("Location: /game/plateau");
            exit();
        }

        // Charger les thèmes pour l'affichage
        $themes = require __DIR__ . '/../config/themes.php';
        $this->render('game/index', ['themes' => $themes]);
    }

    public function plateau()
    {
        // Permet de changer le thème via GET
        $theme = get('theme');
        if ($theme) {
            $themes = require __DIR__ . '/../config/themes.php';
            if (isset($themes[$theme])) {
                $_SESSION['theme'] = $theme;
                $_SESSION['theme_config'] = $themes[$theme];
            }
        }

        if (!isset($_SESSION['jeu'])) {
            header("Location: /game");
            exit();
        }

        $deck = $_SESSION['jeu'];

        // Vérifier si toutes les cartes sont trouvées
        $toutEstTrouve = true;
        foreach ($deck as $carte) {
            if (!$carte->getEstTrouvee()) {
                $toutEstTrouve = false;
                break;
            }
        }
        if ($toutEstTrouve) {
            header("Location: /game/bravo");
            exit();
        }

        $this->render('game/plateau', ['jeu' => $deck]);
    }

    public function play()
    {
        if (!isset($_SESSION['jeu'])) {
            header("Location: /game");
            exit();
        }

        $index = get("i");
        $deck = $_SESSION['jeu'];

        $deck[$index]->setEstRetournee(true);
        $_SESSION['jeu'] = $deck;

        header("Refresh: 1; url=/game/plateau");
        $this->render('game/plateau', ['jeu' => $deck]);

        $cartesRetournees = [];
        foreach ($deck as $carte) {
            if ($carte->getEstRetournee() && !$carte->getEstTrouvee()) {
                $cartesRetournees[] = $carte;
            }
        }

        if (count($cartesRetournees) == 2) {
            $carteA = $cartesRetournees[0];
            $carteB = $cartesRetournees[1];

            if ($carteA->getId() === $carteB->getId()) {
                // ✅ Paire trouvée
                $carteA->setEstTrouvee(true);
                $carteB->setEstTrouvee(true);
                $carteA->setEstRetournee(false);
                $carteB->setEstRetournee(false);

                // Sauvegarde immédiate
                $_SESSION['jeu'] = $deck;

                // Vérification victoire
                $toutEstTrouve = true;
                foreach ($deck as $carte) {
                    if (!$carte->getEstTrouvee()) {
                        $toutEstTrouve = false;
                        break;
                    }
                }

                if ($toutEstTrouve) {
                    // Afficher brièvement le plateau avec toutes les paires trouvées
                    header("Refresh: 2; url=/game/bravo");
                    $this->render('game/plateau', ['jeu' => $deck]);
                    exit();
                }

                // Paire trouvée mais partie pas terminée
                header("Refresh: 1; url=/game/plateau");
                $this->render('game/plateau', ['jeu' => $deck]);
                exit();
            } else {
                // Paire non trouvée
                $carteA->setEstRetournee(false);
                $carteB->setEstRetournee(false);
                $_SESSION['jeu'] = $deck;

                header("Refresh: 2; url=/game/plateau");
                $this->render('game/plateau', ['jeu' => $deck]);
                exit();
            }
        }

        // Une seule carte retournée, on affiche sans refresh (la carte reste visible)
        $this->render('game/plateau', ['jeu' => $deck]);
        exit();
    }

    public function bravo()
    {
        if (!isset($_SESSION['jeu']) || !isset($_SESSION['debut_partie'])) {
            header("Location: /game");
            exit();
        }


        //Calcul du temps (Durée = Maintenant - Début)
        $fin = time();
        $debut = $_SESSION['debut_partie'];
        $dureeEnSecondes = $fin - $debut;

        //On convertit les secondes en format "00.02.15" pour SQL (TIME) gmdate

        $tempsFormatSQL = gmdate("H:i:s", $dureeEnSecondes);

        $nbPaires = $_SESSION['nb_paires'];

        $idUtilisateur = $_SESSION['user']['id'] ?? 1;

        $scoreModel = new Score();
        $scoreModel->save($idUtilisateur, $tempsFormatSQL, $nbPaires);

        unset($_SESSION['jeu']);
        unset($_SESSION['debut_partie']);
        unset($_SESSION['nb_paires']);

        $this->render('game/bravo', [
            'temps' => $tempsFormatSQL,
            'paires' => $nbPaires
        ]);
    }

    public function classement()
    {
        $scoreModel = new Score();

        $scores = $scoreModel->getBestScores();

        $this->render('game/classement', ['scores' => $scores]);
    }
}
