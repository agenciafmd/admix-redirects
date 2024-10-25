<?php

namespace Agenciafmd\Redirects\Models;

use Agenciafmd\Media\Traits\MediaTrait;
use Agenciafmd\Redirects\Database\Factories\RedirectFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Redirect extends Model implements AuditableContract, HasMedia, Searchable
{
    use SoftDeletes, HasFactory, Auditable, MediaTrait;

    protected $guarded = [
        'media',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'star' => 'boolean',
    ];

    public string $searchableType;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->searchableType = config('admix-redirects.name');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->from,
            route('admix.redirects.edit', $this->id)
        );
    }

    public function scopeIsActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    public function scopeSort(Builder $query): void
    {
        $sorts = default_sort(config('admix-redirects.default_sort'));

        foreach ($sorts as $sort) {
            if ($sort['field'] === 'sort') {
                $query->orderByRaw('ISNULL(sort), sort ' . $sort['direction']);
            } else {
                $query->orderBy($sort['field'], $sort['direction']);
            }
        }
    }

    protected static function newFactory(): RedirectFactory
    {
        if (class_exists(\Database\Factories\RedirectFactory::class)) {
            return \Database\Factories\RedirectFactory::new();
        }

        return RedirectFactory::new();
    }
}
