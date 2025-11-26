<div class="home-hero">
  <div class="hero-content">
    <h1 class="hero-title">🦁 Memory nature 🐘</h1>
    <p class="hero-subtitle">Testez votre mémoire dans nos différents thèmes!</p>

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
      <h3>Thèmes</h3>
      <p>Plongez dans différents décors</p>
      <form method="post" action="/home/theme" class="game-form" style="margin-top:15px;">
        <div class="form-group">
          <label for="theme">Choisissez un thème :</label>
          <select name="theme" id="theme">
            <?php foreach ($themes as $key => $theme): ?>
              <option value="<?= $key ?>" <?= ($key === $selectedTheme) ? 'selected' : '' ?>><?= $theme['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn-play" style="width:100%;margin-top:10px;">Valider</button>
      </form>
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