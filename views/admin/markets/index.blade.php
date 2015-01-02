@extends('admin.layout')

@section('title')
All Markets
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.markets.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Market</a>
        <h1>All Markets</h1>
    </header>

    {{ $markets->links() }}

    @if ($markets)
        <ul class="list-group">
            @foreach ($markets as $market)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $market->name }}</h4>
                    {{ Button::primary('Edit')->asLinkto(route('admin.markets.show', $market->id)) }}
                    {{ Form::inline(['route' => ['admin.markets.destroy', $market->id], 'method' => 'delete', 'class' => 'form-button']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No Markets Found</p>
    @endif

    {{ $markets->links() }}
@stop
