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

    'stacked_scope' => [ //if that's true, as soon as we use sizeX, it stacks the labels based on the scope
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
        'size' => true, //If true, size method works on Detail Page automatically. If false, you should tu use sizeOnDetails method
        'remove_bottom_border' => true, //If true, removeBottomBorder works on Detail Page
        'stacked' => true, //If true, stacks is automatic
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
    ],
    'default_size' => [
        'detail' => 'w-full',
        'creating' => 'w-full',
        'updating' => 'w-full',
    ]
];