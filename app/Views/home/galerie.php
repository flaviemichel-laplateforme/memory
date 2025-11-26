<div class="galerie-container">
    <h1 class="galerie-title">🎴 Galerie des Cartes</h1>
    <p class="galerie-subtitle">Découvrez tous les animaux de la savane</p>

    <div class="cards-gallery-landscape">
        <?php
        $cardsDir = __DIR__ . '/../../../public/assets/images/cards/';
        $cards = [];

        if (is_dir($cardsDir)) {
            $files = scandir($cardsDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                    $cards[] = $file;
                }
            }
        }

        if (empty($cards)): ?>
            <div class="no-cards">
                <p>🦁 Aucune carte disponible pour le moment.</p>
                <p>Les cartes seront ajoutées dans le dossier <code>public/assets/images/cards/</code></p>
            </div>
            <?php else:
            foreach ($cards as $card): ?>
                <div class="gallery-card-landscape">
                    <div class="gallery-card-inner-landscape">
                        <div class="gallery-card-front-landscape">
                            <img src="/assets/images/cards/<?= esc($card) ?>" alt="Carte <?= esc(pathinfo($card, PATHINFO_FILENAME)) ?>" class="gallery-img-landscape">
                        </div>
                        <div class="gallery-card-back-landscape">
                            <div class="dos"></div>
                        </div>
                    </div>
                    <p class="card-name-landscape"><?= esc(ucfirst(pathinfo($card, PATHINFO_FILENAME))) ?></p>
                </div>
        <?php endforeach;
        endif; ?>
    </div>

    <div class="galerie-actions">
        <a href="/game" class="btn-primary">🎮 Jouer maintenant</a>
    </div>
</div>