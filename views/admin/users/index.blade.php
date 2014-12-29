@extends('admin.layout')

@section('title')
All Users
@stop

@section('content')
    <header class="page-header">
        <a href="{{ URL::route('admin.users.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New User</a>
        <h1>Users</h1>
    </header>

    {{ $users->links() }}

    @if ($users)
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $user->username }} <small>{{ $user->email }}</small></h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.users.show', ['id' => $user->id])) }}
                    {{ Form::inline([
                        'route' => ['admin.users.destroy', $user->id],
                        'class' => 'form-button',
                        'method'    => 'delete'
                    ]) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else

    @endif

    {{ $users->links() }}
@stop
