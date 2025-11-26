<div class="galerie-container">
    <h1 class="galerie-title">🎴 Galerie des Cartes</h1>
    <p class="galerie-subtitle">Découvrez toutes les cartes disponibles par thème</p>

    <?php
    // Charger les thèmes
    $themes = require __DIR__ . '/../../config/themes.php';

    foreach ($themes as $themeKey => $themeData):
        $cardsDir = __DIR__ . '/../../../public/assets/images/themes/' . $themeData['folder'];
        $cards = [];

        if (is_dir($cardsDir)) {
            $files = scandir($cardsDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                    $cards[] = $file;
                }
            }
        }

        if (!empty($cards)):
    ?>
            <div class="theme-section">
                <h2 class="theme-title"><?= $themeData['emoji'] ?> <?= esc($themeData['name']) ?></h2>
                <div class="cards-gallery-landscape">
                    <?php foreach ($cards as $card): ?>
                        <div class="gallery-card-landscape">
                            <div class="gallery-card-inner-landscape">
                                <div class="gallery-card-front-landscape">
                                    <img src="/assets/images/themes/<?= $themeData['folder'] ?>/<?= esc($card) ?>"
                                        alt="Carte <?= esc(pathinfo($card, PATHINFO_FILENAME)) ?>"
                                        class="gallery-img-landscape">
                                </div>
                                <div class="gallery-card-back-landscape">
                                    <div class="dos"></div>
                                </div>
                            </div>
                            <p class="card-name-landscape"><?= esc(ucfirst(pathinfo($card, PATHINFO_FILENAME))) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    <?php
        endif;
    endforeach;
    ?>

    <div class="galerie-actions">
        <a href="/game" class="btn-primary">🎮 Jouer maintenant</a>
    </div>
</div>