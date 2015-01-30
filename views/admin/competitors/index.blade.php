@extends('admin.layout')

@section('title')
All Competitors
@stop

@section('content')
    <header class="page-header">
        <a href="{{ URL::route('admin.competitors.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Competitor</a>
        <h1>All Competitors</h1>
    </header>

    {{ $competitors->links() }}

    @if ($competitors)
        <ul class="list-group">
            @foreach ($competitors as $competitor)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $competitor->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.competitors.show', ['id' => $competitor->id])) }}
                    {{ Form::inline([
                        'route' => ['admin.competitors.destroy', $competitor->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @endif

    {{ $competitors->links() }}

@stop
