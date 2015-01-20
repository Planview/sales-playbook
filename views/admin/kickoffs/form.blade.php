@extends('admin.layout')

@section('title')
{{ $title }}
@stop

@section('content')
    <header class="page-header">
        <h1>{{ $title }}</h1>
    </header>

    {{ Form::horizontal(['route' => $action, 'method' => $method, 'class' => 'row']) }}
        <div class="col-sm-9">
            <fieldset>
                <legend>Basic Info</legend>
                @if ($kickoff->id)
                    {{ ControlGroup::generate(
                        Form::label('name', 'Year'),
                        "<p class=\"form-control-static\">{$kickoff->name}</p>",
                        null,
                        3
                    ) }}
                @else
                    {{ ControlGroup::generate(
                        Form::label('name', 'Year'),
                        Form::text('name', Input::old('name', $kickoff->name), ['required']) .
                            $errors->first('name', '<span class="label label-danger">:message/span>'),
                        null,
                        3
                    ) }}
                @endif

                {{ ControlGroup::generate(
                    Form::label('active', 'Set as Active Site'),
                    '<div class="checkbox"><label>' . Form::checkbox('active', 1, Input::old('active', $kickoff->active)) . ' Make this the default Sales Kickoff Site</label></div>',
                    Form::help('Setting this as active will make all other sites inactive'),
                    3
                ) }}
            </fieldset>

            <fieldset>
                <legend>Display Properties</legend>

                {{ ControlGroup::generate(
                    Form::label('layout', 'Layout'),
                    Form::text('layout', Input::old('layout', $kickoff->layout)),
                    Form::help('This should be in the form <code>dir.subdir.name</code>'),
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('menu', 'Menu Items'),
                    Form::textarea('menu', Input::old('menu', $kickoff->menu)),
                    Form::help('Each entry on a new line. Separate name and link with a comma'),
                    3
                ) }}
            </fieldset>

        </div>
        <div class="col-sm-3">
            <div class="well">
                {{ Button::primary('Submit')->submit()->block() }}
            </div>
        </div>
    {{ Form::close() }}
@stop
