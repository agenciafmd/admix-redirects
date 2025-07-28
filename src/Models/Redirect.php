<?php

namespace Agenciafmd\Redirects\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Redirects\Database\Factories\RedirectFactory;
use Agenciafmd\Redirects\Observers\RedirectObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

#[ObservedBy([RedirectObserver::class])]
class Redirect extends Model implements AuditableContract
{
    use Auditable, HasFactory, Prunable, SoftDeletes, WithScopes;

    protected array $defaultSort = [
        'is_active' => 'desc',
        'created_at' => 'desc',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function prunable(): Builder
    {
        return static::query()
            ->where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): RedirectFactory
    {
        if (class_exists(\Database\Factories\RedirectFactory::class)) {
            return \Database\Factories\RedirectFactory::new();
        }

        return RedirectFactory::new();
    }
}
