<?php

namespace Agenciafmd\Redirects\Livewire\Pages\Redirect;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Redirects\Models\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Index extends BaseIndex
{
    protected $model = Redirect::class;

    protected string $indexRoute = 'admix.redirects.index';

    protected string $trashRoute = 'admix.redirects.trash';

    protected string $creteRoute = 'admix.redirects.create';

    protected string $editRoute = 'admix.redirects.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix-redirects.name'));

        parent::configure();
    }

    public function filters(): array
    {
        $this->setAdditionalFilters([
            TextFilter::make(__('admix-redirects::fields.from'), 'from')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('from'), 'like', "%{$value}%");
                }),
            TextFilter::make(__('admix-redirects::fields.to'), 'to')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('ro'), 'like', "%{$value}%");
                }),
        ]);

        return parent::filters();
    }

    public function columns(): array
    {
        $this->setAdditionalColumns([
            Column::make(__('admix-redirects::fields.from'), 'from')
                ->sortable()
                ->searchable(),
            Column::make(__('admix-redirects::fields.to'), 'to')
                ->sortable()
                ->searchable(),
        ]);

        return parent::columns();
    }
}
