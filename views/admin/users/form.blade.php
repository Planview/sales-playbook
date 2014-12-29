@extends('admin.layout')

@section('title')
{{ $title }}
@stop

@section('content')
    <header class="page-header">
        <h1>{{ $title }}</h1>
    </header>
    {{ Form::horizontal(['route' => $action, 'class' => 'row', 'method' => $method]) }}
        <div class="col-sm-9">
            <fieldset>
                <legend>General Info</legend>
                {{ ControlGroup::generate(
                    Form::label('username', 'Username'),
                    Form::text('username', Input::old('username') ?: $user->username, ['required']),
                    null,
                    3
                ) }}
                {{ ControlGroup::generate(
                    Form::label('email', 'Email'),
                    Form::email('email', Input::old('email') ?: $user->email, ['required']),
                    null,
                    3
                ) }}
                {{ ControlGroup::generate(
                    Form::label('roles', 'Roles'),
                    Form::select('roles', $roles, Input::old('roles') ?: $user->rolesById(), ['multiple', 'name' => 'roles[]']),
                    null,
                    3
                ) }}
            </fieldset>
            <fieldset>
                <legend>Authentication</legend>
                {{ ControlGroup::generate(
                    Form::label('password', 'New Password'),
                    Form::password('password'),
                    null,
                    3
                ) }}
                {{ ControlGroup::generate(
                    Form::label('password_confirmation', 'Confirm New Password'),
                    Form::password('password_confirmation'),
                    null,
                    3
                ) }}
                @if (null === $user->id)
                    {{ ControlGroup::generate(
                        Form::label('auto_confirm', 'Auto-confirm User'),
                        '<div class="checkbox"><label>' . Form::checkbox('auto_confirm', 1, Input::old('auto_confirm')) . ' Do not send confirmation</label></div>',
                        Form::help('Use this if the user should not receive a confirmation email'),
                        3
                    ) }}
                @endif
            </fieldset>
        </div>
        <div class="col-sm-3">
            <div class="well">
                {{ Button::primary('Submit')->submit()->block() }}
            </div>
        </div>
    {{ Form::close() }}
@stop
