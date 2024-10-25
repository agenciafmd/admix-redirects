<?php

return [
    'name' => 'Redirects',
    'icon' => 'icon fe-trending-up',
    'sort' => 90,
    'default_sort' => [
        '-is_active',
        'sort',
    ],
    'options' => [
        'types' => [
            '301' => 'Permanente (301)',
            '302' => 'Temporário (302)',
        ],
    ],
];
