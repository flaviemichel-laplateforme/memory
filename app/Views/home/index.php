<div class="home-hero" style="position:relative;max-width:1200px;margin:0 auto;padding:40px 0 0 0;">
  <div style="text-align:center;margin-bottom:32px;">
    <h1><a href="/home" style="color:inherit;text-decoration:none;">🦁 Memory nature 🐘</a></h1>
    <p class="hero-subtitle" style="font-size:2rem;margin:10px auto 0 auto;border-radius:0 0 18px 18px;display:block;padding:8px 24px;box-shadow:0 2px 12px rgba(0,0,0,0.08);text-align:center;max-width:500px;">Testez votre mémoire dans nos différents thèmes!</p>
    <div class="hero-actions" style="margin-top:18px;">
      <?php if (isset($_SESSION['user'])): ?>
        <a href="/game" class="btn-hero btn-primary-hero">🎮 Jouer maintenant</a>
        <a href="/game/classement" class="btn-hero btn-secondary-hero">🏆 Voir le classement</a>
      <?php else: ?>
        <a href="/auth/register" class="btn-hero btn-primary-hero">🎯 Commencer à jouer</a>
        <a href="/auth/login" class="btn-hero btn-secondary-hero">🔐 Se connecter</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="theme-gallery-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));grid-template-rows:repeat(2, 1fr);gap:30px;justify-items:center;align-items:center;padding-bottom:10px;max-width:900px;margin:0 auto;">
    <?php foreach ($themes as $key => $theme): ?>
      <a href="/game/plateau?theme=<?= urlencode($key) ?>" class="theme-preview-btn" style="display:block;margin:0;padding:0;max-width:340px;width:100%;cursor:pointer;text-decoration:none;">
        <div class="theme-preview-landscape" style="border-radius:20px;box-shadow:0 4px 18px rgba(0,0,0,0.12);border:5px solid <?= ($key === $selectedTheme) ? '#FFD700' : '#eee' ?>;overflow:hidden;transition:border-color 0.3s;background: url('<?= $theme['background'] ?>') center/cover no-repeat;height:140px;display:flex;align-items:flex-end;justify-content:flex-start;position:relative;min-width:280px;">
          <span style="position:absolute;top:18px;left:18px;font-size:2.5rem;filter:drop-shadow(0 2px 6px #fff);z-index:2;"><?= $theme['emoji'] ?></span>
          <span style="background:rgba(255,255,255,0.85);border-radius:0 12px 0 0;padding:10px 22px;font-weight:700;font-size:1.2rem;color:#654321;box-shadow:0 2px 8px rgba(0,0,0,0.08);margin-bottom:0;position:absolute;bottom:0;left:0;z-index:2;"><?= htmlspecialchars($theme['name']) ?></span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</div>