<?php

use Agenciafmd\Redirects\Livewire\Pages;

Route::get('/redirects', Pages\Redirect\Index::class)
    ->name('admix.redirects.index');
Route::get('/redirects/trash', Pages\Redirect\Index::class)
    ->name('admix.redirects.trash');
Route::get('/redirects/create', Pages\Redirect\Component::class)
    ->name('admix.redirects.create');
Route::get('/redirects/{redirect}/edit', Pages\Redirect\Component::class)
    ->name('admix.redirects.edit');
