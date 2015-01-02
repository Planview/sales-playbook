@extends('admin.layout')

@section('title')
All Sales Regions
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.planview-regions.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Region</a>
        <h1>All Sales Regions</h1>
    </header>

    {{ $regions->links() }}

    @if ($regions)
        <ul class="list-group">
            @foreach ($regions as $region)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $region->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.planview-regions.show', $region->id)) }}
                    {{ Form::inline(['route' => ['admin.planview-regions.destroy', $region->id], 'method' => 'delete', 'class' => 'form-button']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No <b>Sales Regions</b> found.</p>
    @endif

    {{ $regions->links() }}
@stop
