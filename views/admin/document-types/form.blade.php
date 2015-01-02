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
            {{ ControlGroup::generate(
                Form::label('name', 'Name'),
                Form::text('name', Input::old('name', $type->name), ['required']) .
                    $errors->first('name', '<span class="label label-danger">:message</span>'),
                null,
                3
            ) }}
            {{ ControlGroup::generate(
                Form::label('internal_only', 'Internal Only'),
                '<div class="checkbox"><label>' . Form::checkbox('internal_only', 1, Input::old('internal_only', $type->internal_only)) . ' This document type should not be used outside of Planview</label></div>' .
                    $errors->first('internal_only', '<span class="label label-danger">:message</span>'),
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
