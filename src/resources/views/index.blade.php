@extends('agenciafmd/admix::partials.crud.index', [
    'route' => (request()->is('*/trash') ? route('admix.redirects.trash') : route('admix.redirects.index'))
])

@section('title')
    @if(request()->is('*/trash'))
        Lixeira de
    @endif
    {{ config('admix-redirects.name') }}
@endsection

@section('actions')
    @if(request()->is('*/trash'))
        @include('agenciafmd/admix::partials.btn.back', ['url' => route('admix.redirects.index')])
    @else
        @can('create', \Agenciafmd\Redirects\Models\Redirect::class)
            @include('agenciafmd/admix::partials.btn.create', ['url' => route('admix.redirects.create'), 'label' => config('admix-redirects.name')])
        @endcan
        @can('restore', \Agenciafmd\Redirects\Models\Redirect::class)
            @include('agenciafmd/admix::partials.btn.trash', ['url' => route('admix.redirects.trash')])
        @endcan
    @endif
@endsection

@section('batch')
    @if(request()->is('*/trash'))
        @can('restore', \Agenciafmd\Redirects\Models\Redirect::class)
            {{ Form::select('batch', [
                    '' => 'com os selecionados',
                    route('admix.redirects.batchRestore') => '- restaurar',
                ], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @else
        @can('delete', \Agenciafmd\Redirects\Models\Redirect::class)
            {{ Form::select('batch', [
                    '' => 'com os selecionados',
                    route('admix.redirects.batchDestroy') => '- remover',
                ], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @endif
@endsection

@section('filters')
  <h6 class="dropdown-header bg-gray-lightest p-2">De</h6>
  <div class="p-2">
    {{ Form::text('filter[from]', filter('from'), [
            'class' => 'form-control form-control-sm'
        ]) }}
  </div>
  <h6 class="dropdown-header bg-gray-lightest p-2">Para</h6>
  <div class="p-2">
    {{ Form::text('filter[to]', filter('to'), [
            'class' => 'form-control form-control-sm'
        ]) }}
  </div>
  <h6 class="dropdown-header bg-gray-lightest p-2">Tipo</h6>
  <div class="p-2">
    {{ Form::select('filter[type]', ['' => '-'] +  config('admix-redirects.options.types'), filter('type'), [
            'class' => 'form-control form-control-sm'
        ]) }}
  </div>
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1 d-none d-md-table-cell">&nbsp;</th>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th>{!! column_sort('De', 'from') !!}</th>
                    <th>{!! column_sort('Para', 'to') !!}</th>
                    <th>{!! column_sort('Tipo', 'type') !!}</th>
                    <th class="w-1">{!! column_sort('Ativo', 'is_active') !!}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <label class="mb-1 custom-control custom-checkbox">
                                <input type="checkbox" class="js-check custom-control-input"
                                       name="check[]" value="{{ $item->id }}">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </td>
                        <td><span class="text-muted">{{ $item->id }}</span></td>
                        <td>{{ $item->from }}</td>
                        <td>{{ $item->to }}</td>
                        <td>{{ $item->type }}</td>
                        <td>
                            @livewire('admix::is-active', ['myModel' => get_class($item), 'myId' => $item->id])
                        </td>
                        @if(request()->is('*/trash'))
                            <td class="w-1 text-right">
                                @include('agenciafmd/admix::partials.btn.restore', ['url' => route('admix.redirects.restore', $item->id)])
                            </td>
                        @else
                            <td class="w-1 text-center">
                                <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="icon">
                                        <i class="icon fe-more-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @can('update', \Agenciafmd\Redirects\Models\Redirect::class)
                                            @include('agenciafmd/admix::partials.btn.edit', ['url' => route('admix.redirects.edit', $item->id)])
                                        @endcan
                                        @can('delete', \Agenciafmd\Redirects\Models\Redirect::class)
                                            @include('agenciafmd/admix::partials.btn.remove', ['url' => route('admix.redirects.destroy', $item->id)])
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $items->appends(request()->except(['page']))->links() !!}
    @else
        @include('agenciafmd/admix::partials.info.not-found')
    @endif
@endsection

@push('styles')
  <style>
    .dropdown-menu .p-2:nth-child(4),
    .dropdown-menu .p-2:nth-child(5),
    .dropdown-menu .p-2:nth-child(6),
    .dropdown-menu .p-2:nth-child(7),
    .page-subheader {
      display: none;
    }

    .dimmer-content > .card-header > .col-md-6:nth-child(1) {
      visibility: hidden;
    }
  </style>
@endpush
