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
                <legend>Basic Info</legend>
                {{ ControlGroup::generate(
                    Form::label('name', 'Slug'),
                    Form::text('name', Input::old('name') ?: $permission->name, ['required', 'class' => 'input-code']) . $errors->first('name', '<span class="label label-danger">:message</span>'),
                    Form::help('The slug should consist of only upper- and lowercase letters, numbers, and underscores'),
                    3
                ) }}
                {{ ControlGroup::generate(
                    Form::label('display_name', 'Display Name'),
                    Form::text('display_name', Input::old('display_name') ?: $permission->display_name, ['required']) . $errors->first('display_name', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}
            </fieldset>
            <fieldset>
                <legend>Attached Roles</legend>
                {{ ControlGroup::generate(
                    Form::label('roles', 'Roles'),
                    Form::select('roles', $roles, Input::old('roles') ?: $permission->rolesById(), ['name' => 'roles[]', 'multiple']),
                    null,
                    3
                ) }}
            </fieldset>
        </div>
        <div class="col-sm-3">
            <div class="well">
                {{ Button::primary('Submit')->block()->submit() }}
            </div>
        </div>
    {{ Form::close() }}
@stop
