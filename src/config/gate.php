<?php

return [
    [
        'name' => config('admix-redirects.name'),
        'policy' => '\Agenciafmd\Redirects\Policies\RedirectPolicy',
        'abilities' => [
            [
                'name' => 'visualizar',
                'method' => 'view',
            ],
            [
                'name' => 'criar',
                'method' => 'create',
            ],
            [
                'name' => 'atualizar',
                'method' => 'update',
            ],
            [
                'name' => 'deletar',
                'method' => 'delete',
            ],
            [
                'name' => 'restaurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 10,
    ],
];
