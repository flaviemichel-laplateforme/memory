<div class="#">

    <h1>Meilleurs scores</h1>

    <?php if (empty($scores)): ?>
        <p class="#">Aucun score enregistré pour le moment.</p>
        <a href="/game">Jouer une partie</a>
    <?php else: ?>
        <table class="#">
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
                    <tr>
                        <td class="#">
                            <?php
                            $rang = $index + 1;
                            if ($rang === 1) echo 'Vous avez gagné!!';
                            elseif ($rang === 2) echo 'Vous avez fini deuxième !';
                            elseif ($rang === 3) echo 'Vous avez fini troisième !';
                            else echo $rang;
                            ?>
                        </td>

                        <td class="#"><?= esc($score['login']) ?></td>
                        <td class="#"><?= esc($score['temps']) ?></td>
                        <td class="#"><?= esc($score['nombre_paires']) ?>Paires</td>
                        <td class="#"><?= format_date($score['date_creation']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="#">
            <a href="/game" class="#">Nouvelle partie</a>
        </div>
    <?php endif; ?>
</div>