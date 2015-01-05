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
                <legend>Basic Information</legend>
                {{ ControlGroup::generate(
                    Form::label('title', 'Title'),
                    Form::text('title', Input::old('title', $document->title), ['required']) .
                        $errors->first('title' , '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('url', 'URL'),
                    Form::url('url', Input::old('url', $document->url), ['required']) .
                        $errors->first('url' , '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}
            </fieldset>

            <fieldset>
                <legend>Categories</legend>
                {{ ControlGroup::generate(
                    Form::label('document_type_id', 'Type'),
                    Form::select('document_type_id', $types, Input::old('document_type_id', $document->document_type_id), ['required']) .
                        $errors->first('document_type_id' , '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('customer_id', 'Customer'),
                    Form::select('customer_id', $customers, Input::old('customer_id', $document->customer_id) .
                        $errors->first('customer_id' , '<span class="label label-danger">:message</span>'), ['required']),
                    null,
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
