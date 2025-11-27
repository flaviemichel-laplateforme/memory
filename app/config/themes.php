<?php

/**
 * Configuration des thèmes du jeu Memory
 * Chaque thème possède ses propres couleurs, images et fonds
 */

return [
    'jungle' => [
        'name' => 'Jungle Tropicale',
        'emoji' => '🦜',
        'folder' => 'jungle',
        'background' => '/assets/images/jungle-bg.jpg',
        'card_back' => '/assets/images/themes/jungle/dos.jpg',
        'colors' => [
            'primary' => '#228B22',
            'secondary' => '#145214',
            'accent' => '#FFD700',
            'light' => '#e6ffe6',
            'gradient_start' => '#FFD700',
            'gradient_end' => '#228B22'
        ]
    ],
    'montagne' => [
        'name' => 'Montagne Glacée',
        'emoji' => '🏔️',
        'folder' => 'montagne',
        'background' => '/assets/images/montagne-bg.jpg',
        'card_back' => '/assets/images/themes/montagne/dos.jpg',
        'colors' => [
            'primary' => '#5D8AA8',
            'secondary' => '#274472',
            'accent' => '#A9D6E5',
            'light' => '#f0f8ff',
            'gradient_start' => '#A9D6E5',
            'gradient_end' => '#274472'
        ]
    ],
    'animaux' => [
        'name' => 'Animaux Rigolos',
        'emoji' => '🦊',
        'folder' => 'animaux',
        'background' => '/assets/images/animaux-bg.jpg',
        'card_back' => '/assets/images/themes/animaux/dos.jpg',
        'colors' => [
            'primary' => '#ff9800',
            'secondary' => '#ffb74d',
            'accent' => '#4caf50',
            'light' => '#fffde7',
            'gradient_start' => '#ffb74d',
            'gradient_end' => '#ff9800'
        ]
    ],
    'polaire' => [
        'name' => 'Pôle Nord',
        'emoji' => '🐧',
        'folder' => 'polaire',
        'background' => '/assets/images/polaire-bg.jpg',
        'card_back' => '/assets/images/themes/polaire/dos.jpg',
        'colors' => [
            'primary' => '#B0E0E6',
            'secondary' => '#4682B4',
            'accent' => '#fff',
            'light' => '#e0f7fa',
            'gradient_start' => '#B0E0E6',
            'gradient_end' => '#4682B4'
        ]
    ],
    'savane' => [
        'name' => 'Savane Africaine',
        'emoji' => '🦁',
        'folder' => 'savane',
        'background' => '/assets/images/fond.jpg',
        'card_back' => '/assets/images/dos.jpg',
        'colors' => [
            'primary' => '#8B4513',      // Marron
            'secondary' => '#654321',    // Marron foncé
            'accent' => '#DAA520',       // Or
            'light' => '#FFF8DC',        // Beige
            'gradient_start' => '#DAA520',
            'gradient_end' => '#CD853F'
        ]
    ],
    'ocean' => [
        'name' => 'Océan Mystérieux',
        'emoji' => '🐋',
        'folder' => 'ocean',
        'background' => '/assets/images/ocean-bg.jpg',
        'card_back' => '/assets/images/themes/ocean/dos.jpg',
        'colors' => [
            'primary' => '#006994',      // Bleu océan
            'secondary' => '#003d5c',    // Bleu profond
            'accent' => '#00b4d8',       // Cyan
            'light' => '#e0f7ff',        // Bleu clair
            'gradient_start' => '#00b4d8',
            'gradient_end' => '#0077b6'
        ]
    ],
    'foret' => [
        'name' => 'Forêt Enchantée',
        'emoji' => '🌲',
        'folder' => 'foret',
        'background' => '/assets/images/foret-bg.jpg',
        'card_back' => '/assets/images/themes/foret/dos.jpg',
        'colors' => [
            'primary' => '#2d5016',      // Vert forêt
            'secondary' => '#1a3009',    // Vert foncé
            'accent' => '#76b947',       // Vert clair
            'light' => '#e8f5e3',        // Vert pâle
            'gradient_start' => '#76b947',
            'gradient_end' => '#52b788'
        ]
    ],
    'espace' => [
        'name' => 'Espace Cosmique',
        'emoji' => '🚀',
        'folder' => 'espace',
        'background' => '/assets/images/espace-bg.jpg',
        'card_back' => '/assets/images/themes/espace/dos.jpg',
        'colors' => [
            'primary' => '#1a1a2e',      // Bleu nuit
            'secondary' => '#0f0f1e',    // Noir bleuté
            'accent' => '#9d4edd',       // Violet
            'light' => '#e0d9ff',        // Violet pâle
            'gradient_start' => '#9d4edd',
            'gradient_end' => '#c77dff'
        ]
    ],
    'desert' => [
        'name' => 'Désert Doré',
        'emoji' => '🐪',
        'folder' => 'desert',
        'background' => '/assets/images/desert-bg.jpg',
        'card_back' => '/assets/images/themes/desert/dos.jpg',
        'colors' => [
            'primary' => '#c4722c',      // Orange sable
            'secondary' => '#8b4513',    // Marron terre
            'accent' => '#f4a261',       // Orange clair
            'light' => '#fff4e6',        // Beige clair
            'gradient_start' => '#f4a261',
            'gradient_end' => '#e76f51'
        ]
    ]
];
