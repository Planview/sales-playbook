@extends('admin.layout')

@section('title')
{{ $title }}
@stop

@section('content')
    <header class="page-header">
        <h1>{{ $title }}</h1>
    </header>

    {{ Form::open(['route' => $action, 'method' => $method, 'class' => 'row']) }}
        <div class="col-sm-9">
            <fieldset>
                <legend>Basic Info</legend>

                {{ ControlGroup::generate(
                    Form::label('slug', 'Page Slug'),
                    Form::text('slug', Input::old('slug', $page->slug), [$page->id ? 'readonly' : 'required']) .
                        $errors->first('slug', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}
            </fieldset>
            <fieldset>
                <legend>Page Markup</legend>
                    <div role="tabpanel">

                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#html" aria-controls="html" role="tab" data-toggle="tab">HTML</a></li>
                        <li role="presentation"><a href="#styles" aria-controls="styles" role="tab" data-toggle="tab">Styles</a></li>
                        <li role="presentation"><a href="#scripts" aria-controls="scripts" role="tab" data-toggle="tab">Scripts</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content" style="padding-top:10px;">
                        <div role="tabpanel" class="tab-pane active" id="html">
                            {{ ControlGroup::generate(
                                Form::label('html', 'HTML body', ['class' => 'sr-only']) .
                                    $errors->first('html', '<span class="label label-danger">:message</span>'),
                                Form::textarea('html', Input::old('html', $page->html), ['class' => 'ide'])
                            ) }}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="styles">
                            {{ ControlGroup::generate(
                                Form::label('styles', 'HTML body', ['class' => 'sr-only']),
                                Form::textarea('styles', Input::old('styles', $page->styles), ['class' => 'ide'])
                            ) }}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="scripts">
                            {{ ControlGroup::generate(
                                Form::label('scripts', 'HTML body', ['class' => 'sr-only']),
                                Form::textarea('scripts', Input::old('scripts', $page->scripts), ['class' => 'ide'])
                            ) }}
                        </div>
                      </div>

                    </div>
            </fieldset>
        </div>
        <div class="col-sm-3">
            <div class="well">
                {{ Button::primary('Submit')->submit()->block() }}
            </div>
        </div>
    {{ Form::close() }}
@stop

@section('styles')
    @parent
    {{ HTML::style('bower_components/codemirror/lib/codemirror.css') }}
    {{ HTML::style('bower_components/codemirror/theme/solarized.css') }}
@stop

@section('scripts')
    @parent
    {{ HTML::script('js/admin-codemirror.js') }}
@stop
