<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Card;

class GameController extends BaseController
{
    public function index()
    {
        if (is_post()) {

            $nbPaires = intval(post('nombre_paires'));
            $deck = [];

            for ($c = 1; $c <= $nbPaires; $c++) {
                $image = "https://picsum.photos/id/" . ($c + 10) . "/100";

                $carte1 = new Card($c, $image);
                $carte2 = new Card($c, $image);

                $deck[] = $carte1;
                $deck[] = $carte2;
            }

            shuffle($deck);
            $_SESSION['jeu'] = $deck;

            header("Location: /game/plateau");
            exit();
        }

        $this->render('game/index');
    }

    public function plateau()
    {
        if (!isset($_SESSION['jeu'])) {
            header("Location: /game");
            exit();
        }

        $deck = $_SESSION['jeu'];

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
            } else {
                // ✅ CORRECTION : Modifier AVANT render()
                // 1. On cache les cartes pour la prochaine fois
                $carteA->setEstRetournee(false);
                $carteB->setEstRetournee(false);
                $_SESSION['jeu'] = $deck;

                // 2. On affiche avec refresh (utilisateur voit brièvement les cartes)
                header("Refresh: 1; url=/game/plateau");
                $this->render('game/plateau', ['jeu' => $deck]);
                exit();
            }
        }

        // Sauvegarde
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
            header("Location: /game/bravo");
            exit();
        }

        header("Location: /game/plateau");
        exit();
    }
}
