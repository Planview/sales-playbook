@extends('admin.layout')

@section('title')
All Sales Subregions
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.planview-subregions.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Subregion</a>
        <h1>All Sales Subregions</h1>
    </header>

    @if ($subregions)
        {{ $subregions->links() }}
        <ul class="list-group">
            @foreach ($subregions as $subregion)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $subregion->name }} <small>{{ $subregion->planviewRegion->name }}</small></h4>

                    {{ Button::primary('Edit')->asLinkTo(route('admin.planview-subregions.show', $subregion->id)) }}

                    {{ Form::inline(['route' => ['admin.planview-subregions.destroy', $subregion->id], 'method' => 'delete', 'class' => 'form-button']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
        {{ $subregions->links() }}
    @else
        <p class="lead">No <b>Subregions</b> found.</p>
    @endif
@stop
