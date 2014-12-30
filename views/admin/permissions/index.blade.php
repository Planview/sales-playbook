@extends('admin.layout')

@section('title')
Manage Permissions
@stop

@section('content')
    <header class="page-header">
        <a href="{{ URL::route('admin.permissions.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Permisson</a>
        <h1>Manage Permissions</h1>
    </header>

    {{ $permissions->links() }}

    @if ($permissions)
        <ul class="list-group">
            @foreach ($permissions as $permission)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $permission->display_name }} <small>{{ $permission->name }}</small></h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.permissions.show', ['id' => $permission->id])) }}
                    {{ Form::inline([
                        'route' => ['admin.permissions.destroy', $permission->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No Users Found</p>
    @endif

    {{ $permissions->links() }}
@stop
