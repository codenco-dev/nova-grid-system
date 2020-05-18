<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Automatism stacked
    |--------------------------------------------------------------------------
    |
    | If true, the size macro put automatically the stacked field attritute to true
    |
    */
    'nova_grid_system_enabled' => true, //desactive

    'stacked_scope' => [ //si true, dès qu'on utilise sizeX cela stacked les labels selon le scope
        'creating' => true,
        'detail' => true,
        'updating' => true,
    ],
    'size_scope' => [
        'creating' => true,
        'detail' => true,
        'updating' => true,
    ],
    'remove_bottom_border_scope' => [
        'creating' => true,
        'detail' => true,
        'updating' => true,
    ],
    'detail' => [
        'size' => true, //la size fonctionne en mode detail en utilisant size (si celui d'en dessous est à true : c'est la merde ici) ou sizeOnDetails
        'remove_bottom_border' => true, //on peut supprimer les bottomBorder sur détail
        'stacked' => true, //on peut utiliser la methode sur le detail
    ],
    'creating' => [
        'size' => true,
        'remove_bottom_border' => true,
        'stacked' => true,
    ],
    'updating' => [
        'size' => true,
        'remove_bottom_border' => true,
        'stacked' => true,
    ]
];