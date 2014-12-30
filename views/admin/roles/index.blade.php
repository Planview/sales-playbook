@extends('admin.layout')

@section('title')
Roles
@stop

@section('content')
    <header class="page-header">
        <a href="{{ URL::route('admin.roles.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Role</a>
        <h1>Manange Roles</h1>
    </header>

    {{ $roles->links() }}

    @if ($roles)
        <ul class="list-group">
            @foreach ($roles as $role)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $role->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.roles.show', ['id' => $role->id])) }}
                    {{ Form::inline([
                        'route' => ['admin.roles.destroy', $role->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No Roles Found</p>
    @endif

    {{ $roles->links() }}
@stop
