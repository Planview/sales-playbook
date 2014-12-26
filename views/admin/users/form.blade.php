@extends('admin.layout')

@section('title')
Create a New User
@stop

@section('content')
    <header class="page-header">
        <h1>Create a New User</h1>
    </header>
    {{ Form::horizontal(['route' => 'admin.users.store', 'class' => 'row']) }}
        <div class="col-sm-9">
            {{ ControlGroup::generate(
                Form::label('username', 'Username'),
                Form::text('username', Input::old('username') ?: $user->username),
                null,
                3
            ) }}
            {{ ControlGroup::generate(
                Form::label('email', 'Email'),
                Form::email('email', Input::old('email') ?: $user->email),
                null,
                3
            ) }}
            {{ ControlGroup::generate(
                Form::label('roles', 'Roles'),
                Form::select('roles', $roles, Input::old('roles') ?: $user->roles, ['multiple' => 'multiple']),
                null,
                3
            ) }}
        </div>
        <div class="col-sm-3">
            <div class="well">
                {{ Button::primary('Submit')->submit()->block() }}
            </div>
        </div>
    {{ Form::close() }}
@stop
