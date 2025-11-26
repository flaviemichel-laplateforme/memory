<div class="victory-container">
    <div class="crown-icon">👑</div>

    <h1 class="victory-title">Victoire Royale !</h1>
    <p class="victory-subtitle">Félicitations, Noble Joueur !</p>

    <div class="victory-badge">
        <div class="badge-star">⭐</div>
        <p class="victory-message">Vous avez triomphé avec brio dans la savane</p>
    </div>

    <div class="victory-stats">
        <div class="stat-card">
            <div class="stat-icon">⏱️</div>
            <div class="stat-label">Temps Royal</div>
            <div class="stat-value"><?= $temps ?></div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-label">Niveau</div>
            <div class="stat-value"><?= $paires ?> paires</div>
        </div>
    </div>

    <div class="victory-actions">
        <a href="/game" class="btn-royal btn-replay">🎮 Nouvelle partie</a>
        <a href="/game/classement" class="btn-royal btn-ranking">🏆 Classement</a>
    </div>

</div>