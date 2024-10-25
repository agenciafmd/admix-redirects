<?php

return [
    'redirect' => [
        'image' => [
            'label' => 'imagem', //label do campo
            'multiple' => false, //se permite o upload multiplo
            'faker_dir' => false, #database_path('faker/redirect/image'),
            'sources' => [
                [
                    'conversion' => 'min-width-1366',
                    'media' => '(min-width: 1366px)',
                    'width' => 800,
                    'height' => 450,
                    'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                    'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                ],
                [
                    'conversion' => 'min-width-1280',
                    'media' => '(min-width: 1280px)',
                    'width' => 650,
                    'height' => 366,
                    'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                    'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                ],
            ],
        ],
    ],
];