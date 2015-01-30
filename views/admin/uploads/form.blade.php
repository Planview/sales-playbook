@extends('admin.layout')

@section('title')
{{ $title }}
@stop

@section('content')
    <header class="page-header">
        <h1>{{ $title }}</h1>
    </header>

    {{ Form::horizontal(['route' => $action, 'method' => $method, 'class' => 'row', 'files' => true]) }}

        <div class="col-sm-9">

            {{ ControlGroup::generate(
                Form::label('name', 'Name'),
                Form::text('name', Input::old('name', $upload->name), ['required']) .
                    $errors->first('name', '<span class="label label-danger">:message</span>'),
                null,
                3
            ) }}

            {{ ControlGroup::generate(
                Form::label('file', 'File'),
                Form::file('file', ['required']),
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
