@extends('admin.layout')

@section('title')
All Industries
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.industries.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Industry</a>
        <h1>All Industries</h1>
    </header>

    @if ($industries)
        <ul class="list-group">
            @foreach ($industries as $industry)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $industry->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.industries.show', $industry->id)) }}
                    {{ Form::inline([
                        'route' => ['admin.industries.destroy', $industry->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @endif
@stop
