<p align="center"><a href="https://fmd.ag" target="_blank"><img src="https://raw.githubusercontent.com/agenciafmd/admix-redirects/master/docs/fmd.png" alt="Logo da F&MD"></a></p>


## F&MD - Redirects

![Área Administrativa](https://raw.githubusercontent.com/agenciafmd/admix-redirects/master/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-redirects.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-redirects)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Gestão de redirecionamentos de forma simples e eficiente.

## Instalação

```bash
composer require agenciafmd/admix-redirects:v8.x-dev
```

Execute a migração

```bash
php artisan migrate
```

Se precisar do seed, faça a publicação

```bash
php artisan vendor:publish --tag=admix-postal:seeders
```

**Não esqueça**

- de adicionar o `RedirectsTableSeeder::class` em `database/seeders/DatabaseSeeder.php`
- alterar namespace do `RedirectsTableSeeder.php` para `Database\Seeders`
- de executar o `composer dumpautoload`

## Uso

Adicione o middleware ao grupo `web` no `$middlewareGroups` em `app/Http/Kernel.php` ANTES de `\Illuminate\Routing\Middleware\SubstituteBindings::class`:

```php
<?php

protected $middlewareGroups = [
    'web' => [
        ...
        \Agenciafmd\Redirects\Http\Middleware\UseRedirectPackage::class,
    ],
];
```

Adicione o `fallback` ao fim das suas rotas web:
`
Route::fallback(static fn() => abort(404));
`
Ex.
```php
<?php

use Agenciafmd\Frontend\Http\Controllers\FrontendController;
use Agenciafmd\Frontend\Http\Controllers\HtmlController;
use Illuminate\Support\Facades\Route;

Route::get('html/{any?}', [HtmlController::class, 'index'])
    ->name('frontend.html');
Route::get('/', [FrontendController::class, 'index'])
    ->name('frontend.index');
Route::fallback(static fn() => abort(404));
```

## Configurações

Caso seja necessário alguma modificação, publique o arquivo de config. com o comando:

```bash
php artisan vendor:publish --tag=admix-redirects:configs
```

Ex.
```php
<?php

return [
    'name' => 'Redirecionamentos',
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
```
