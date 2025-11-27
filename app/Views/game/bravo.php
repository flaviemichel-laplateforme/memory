<div class="victory-container">
    <h1 class="victory-title">Bravo !</h1>
    <p class="victory-subtitle">Toutes les paires ont été trouvées.</p>

    <div class="victory-stats">
        <div class="stat-card">
            <div class="stat-icon">⏱️</div>
            <div class="stat-label">Temps</div>
            <div class="stat-value"><?= $temps ?></div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-label">Nombre de paires</div>
            <div class="stat-value"><?= $paires ?> paires</div>
        </div>
    </div>

    <div class="victory-actions">
        <a href="/game" class="btn-royal btn-replay">🎮 Nouvelle partie</a>
        <a href="/game/classement" class="btn-royal btn-ranking">🏆 Classement</a>
    </div>

</div>