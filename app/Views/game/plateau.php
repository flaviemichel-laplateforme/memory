<div id="plateau-jeu">

    <?php
    // On parcourt toutes les cartes du paquet
    for ($i = 0; $i < count($jeu); $i++) {

        // On récupère l'objet Carte à cette position
        $carte = $jeu[$i];
    ?>

        <div class="carte-conteneur">

            <?php if ($carte->getEstRetournee()): ?>
                <img src="<?= $carte->getImage() ?>" alt="Image du memory">

            <?php else: ?>
                <a href="/game/play?i=<?= $i ?>">
                    <div class="dos"></div>
                </a>
            <?php endif; ?>

        </div>

    <?php
    } // Fin de la boucle for
    ?>

</div>