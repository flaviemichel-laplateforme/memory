<div class="home-hero">
  <div class="hero-content">
    <h1 class="hero-title">🦁 Memory Savane 🐘</h1>
    <p class="hero-subtitle">Testez votre mémoire dans la savane africaine !</p>

    <div class="hero-description">
      <p>🎮 <strong>Trouvez les paires d'animaux</strong> cachées dans la savane</p>
      <p>⏱️ <strong>Battez votre record</strong> de temps</p>
      <p>🏆 <strong>Grimpez au classement</strong> des meilleurs joueurs</p>
    </div>

    <div class="hero-actions">
      <?php if (isset($_SESSION['user'])): ?>
        <a href="/game" class="btn-hero btn-primary-hero">🎮 Jouer maintenant</a>
        <a href="/game/classement" class="btn-hero btn-secondary-hero">🏆 Voir le classement</a>
      <?php else: ?>
        <a href="/auth/register" class="btn-hero btn-primary-hero">🎯 Commencer à jouer</a>
        <a href="/auth/login" class="btn-hero btn-secondary-hero">🔐 Se connecter</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="hero-features">
    <div class="feature-card">
      <div class="feature-icon">🌍</div>
      <h3>Thème Savane</h3>
      <p>Plongez dans l'univers de la savane africaine avec des graphismes immersifs</p>
    </div>

    <div class="feature-card">
      <div class="feature-icon">🎯</div>
      <h3>4 Niveaux</h3>
      <p>De débutant à expert, choisissez votre niveau de difficulté</p>
    </div>

    <div class="feature-card">
      <div class="feature-icon">⚡</div>
      <h3>Chrono</h3>
      <p>Améliorez votre temps et devenez le plus rapide</p>
    </div>
  </div>
</div>