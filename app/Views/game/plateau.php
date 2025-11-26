<?php

$maintenant = time();
$debut = $_SESSION['debut_partie'] ?? $maintenant;
$tempsEcoule = $maintenant - $debut;

$chronoAffiche = gmdate("i:s", $tempsEcoule);

// Récupérer l'image de dos selon le thème
$dosImage = '/assets/images/dos.jpg'; // Par défaut
if (isset($_SESSION['theme_config']) && isset($_SESSION['theme_config']['card_back'])) {
    $dosImage = $_SESSION['theme_config']['card_back'];
}

// Si le fichier n'existe pas, utiliser le dos du dossier du thème
if (isset($_SESSION['theme']) && isset($_SESSION['theme_config'])) {
    $themeDos = '/assets/images/themes/' . $_SESSION['theme_config']['folder'] . '/dos.jpg';
    if (file_exists(__DIR__ . '/../../../public' . $themeDos)) {
        $dosImage = $themeDos;
    }
}
?>

<div class="game-container">

    <div class="info-bar">
        <a href="/game" class="btn-abandon"> Abandonner</a>

        <div class="timer-box">
            <span> Temps :</span>
            <span style="font-family: monospace; font-size: 1.2em;">
                <?= $chronoAffiche ?>
            </span>
        </div>
    </div>

    <div id="plateau-jeu" data-cards="<?= count($jeu) ?>">
        <?php
        for ($i = 0; $i < count($jeu); $i++) {
            $carte = $jeu[$i];

            $classeSpeciale = $carte->getEstTrouvee() ? 'trouvee' : '';
        ?>

            <div class="carte-conteneur <?= $classeSpeciale ?>">

                <?php if ($carte->getEstRetournee() || $carte->getEstTrouvee()): ?>
                    <img src="<?= $carte->getImage() ?>" alt="Carte Memory" class="carte-img">

                <?php else: ?>
                    <a href="/game/play?i=<?= $i ?>" style="display:block; width:100%; height:100%; text-decoration:none;">
                        <img src="<?= $dosImage ?>" alt="Dos de carte" class="carte-img">
                    </a>
                <?php endif; ?>

            </div>

        <?php
        } // Fin de la boucle for
        ?>
    </div>