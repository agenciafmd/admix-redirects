<?php

use Agenciafmd\Redirects\Http\Controllers\RedirectController;
use Agenciafmd\Redirects\Models\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('redirects/', [RedirectController::class, 'index'])
    ->name('admix.redirects.index')
    ->middleware('can:view,' . Redirect::class);
Route::get('redirects/trash', [RedirectController::class, 'index'])
    ->name('admix.redirects.trash')
    ->middleware('can:restore,' . Redirect::class);
Route::get('redirects/create', [RedirectController::class, 'create'])
    ->name('admix.redirects.create')
    ->middleware('can:create,' . Redirect::class);
Route::post('redirects/', [RedirectController::class, 'store'])
    ->name('admix.redirects.store')
    ->middleware('can:create,' . Redirect::class);
Route::get('redirects/{redirect}', [RedirectController::class, 'show'])
    ->name('admix.redirects.show')
    ->middleware('can:view,' . Redirect::class);
Route::get('redirects/{redirect}/edit', [RedirectController::class, 'edit'])
    ->name('admix.redirects.edit')
    ->middleware('can:update,' . Redirect::class);
Route::put('redirects/{redirect}', [RedirectController::class, 'update'])
    ->name('admix.redirects.update')
    ->middleware('can:update,' . Redirect::class);
Route::delete('redirects/destroy/{redirect}', [RedirectController::class, 'destroy'])
    ->name('admix.redirects.destroy')
    ->middleware('can:delete,' . Redirect::class);
Route::post('redirects/{id}/restore', [RedirectController::class, 'restore'])
    ->name('admix.redirects.restore')
    ->middleware('can:restore,' . Redirect::class);
Route::post('redirects/batchDestroy', [RedirectController::class, 'batchDestroy'])
    ->name('admix.redirects.batchDestroy')
    ->middleware('can:delete,' . Redirect::class);
Route::post('redirects/batchRestore', [RedirectController::class, 'batchRestore'])
    ->name('admix.redirects.batchRestore')
    ->middleware('can:restore,' . Redirect::class);
