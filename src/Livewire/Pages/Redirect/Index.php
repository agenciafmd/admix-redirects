<?php

namespace Agenciafmd\Redirects\Livewire\Pages\Redirect;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Redirects\Models\Redirect;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\DeleteColumn;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\EditColumn;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\RestoreColumn;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
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

        $filters = parent::filters();

        unset($filters[2]); // nome

        return $filters;
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

        $columns = parent::columns();
        unset($columns[1]); // remove o name

        return $columns;
    }

    //    public function columns(): array
    //    {
    //        $actions = [];
    //        if ($this->isTrash) {
    //            if ($this->user->can('restore', $this->builder()
    //                ->getModel())) {
    //                $actions[] = RestoreColumn::make('Restore')
    //                    ->title(fn ($row) => __('Restore'))
    //                    ->location(fn ($row) => "window.Livewire.dispatchTo('" . str(static::class)
    //                        ->lower()
    //                        ->replace('\\', '.')
    //                        ->toString() . "', 'bulkRestore', { id: {$row->id} })")
    //                    ->attributes(function ($row) {
    //                        return [
    //                            'class' => 'btn ms-0 ms-md-2',
    //                        ];
    //                    });
    //            }
    //        } else {
    //            if ($this->user->can('update', $this->builder()
    //                ->getModel())) {
    //                $actions[] = EditColumn::make('Edit')
    //                    ->title(fn ($row) => __('Edit'))
    //                    ->location(fn ($row) => route($this->editRoute, $row))
    //                    ->attributes(function ($row) {
    //                        return [
    //                            'class' => 'btn ms-2',
    //                        ];
    //                    });
    //            }
    //
    //            if ($this->user->can('delete', $this->builder()
    //                ->getModel())) {
    //                $actions[] = DeleteColumn::make('Delete')
    //                    ->title(fn ($row) => __('Delete'))
    //                    ->location(fn ($row) => $row->id)
    //                    ->attributes(function ($row) {
    //                        return [
    //                            'class' => 'btn ms-2',
    //                        ];
    //                    });
    //            }
    //        }
    //        $actionButtons = array_merge($this->additionalActionButtons, $actions);
    //
    //        return [
    //            Column::make(__('admix::fields.id'), 'id')
    //                ->sortable()
    //                ->searchable(),
    //            ...$this->initialColumns,
    //            Column::make(__('admix-redirects::fields.from'), 'from')
    //                ->sortable()
    //                ->searchable(),
    //            Column::make(__('admix-redirects::fields.to'), 'to')
    //                ->sortable()
    //                ->searchable(),
    //            BooleanColumn::make(__('admix::fields.is_active'), 'is_active')
    //                ->setView('admix-ui::livewire-tables.columns.boolean')
    //                ->sortable()
    //                ->searchable(),
    //            ButtonGroupColumn::make('')
    //                ->excludeFromColumnSelect()
    //                ->attributes(function ($row) {
    //                    return [
    //                        'class' => 'text-end',
    //                    ];
    //                })
    //                ->buttons($actionButtons),
    //        ];
    //    }
}
