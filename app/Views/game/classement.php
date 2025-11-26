<div class="classement-container">

    <h1>🏆 Meilleurs Scores</h1>

    <?php if (empty($scores)): ?>
        <p class="empty-message">Aucun score enregistré pour le moment.</p>
        <a href="/game" class="btn-primary">Jouer une partie</a>
    <?php else: ?>
        <table class="scores-table">
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>Joueur</th>
                    <th>Temps</th>
                    <th>Paires</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scores as $index => $score): ?>
                    <tr class="rank-<?= $index + 1 ?>">
                        <td class="rank-cell">
                            <?php
                            $rang = $index + 1;
                            if ($rang === 1) echo '🥇 1er';
                            elseif ($rang === 2) echo '🥈 2ème';
                            elseif ($rang === 3) echo '🥉 3ème';
                            else echo $rang;
                            ?>
                        </td>

                        <td class="player-cell"><?= esc($score['login']) ?></td>
                        <td class="time-cell">⏱️ <?= esc($score['temps']) ?></td>
                        <td class="pairs-cell"><?= esc($score['nombre_paires']) ?> paires</td>
                        <td class="date-cell"><?= format_date($score['date_creation']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="actions-container">
            <a href="/game" class="btn-play">🎮 Nouvelle partie</a>
        </div>
    <?php endif; ?>
</div>