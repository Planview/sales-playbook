@extends('admin.layout')

@section('title')
All Document Types
@stop

@section('content')
    <header class="page-header">
        <a href="{{ URL::route('admin.document-types.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Create New</a>
        <h1>All Document Types</h1>
    </header>

    @if ($types)
        <ul class="list-group">
            @foreach ($types as $type)
                <li class="list-group-item">
                    <h4 class="list-group-heading">{{ $type->name }}</h4>
                    {{ Button::primary('Edit')->asLinkto(route('admin.document-types.show', $type->id)) }}
                    {{ Form::inline([
                        'route' => ['admin.document-types.destroy', $type->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No Document Types Found.</p>
    @endif
@stop
