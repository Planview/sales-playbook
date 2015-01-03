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

                {{ ControlGroup::generate(
                    Form::label('name', 'Name'),
                    Form::text('name', Input::old('name', $customer->name), ['required']) .
                        $errors->first('name', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('can_use_name', 'Can Use Name?'),
                    '<div class="checkbox"><label>' . Form::checkbox('can_use_name', 1, Input::old('can_use_name', $customer->can_use_name)) . ' This customer has allowed their name to be used</label></div>' .
                        $errors->first('can_use_name', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}
            </fieldset>

            <fieldset>
                <legend>More Information</legend>

                {{ ControlGroup::generate(
                    Form::label('industry_id', 'Industry'),
                    Form::select('industry_id', $industries, Input::old('industry_id', $customer->industry_id), ['required']) .
                        $errors->first('industry_id', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('operating_region_id', 'Operating Region'),
                    Form::select('operating_region_id', $opRegions, Input::old('operating_region_id', $customer->operating_region_id), ['required']) .
                        $errors->first('operating_region_id', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('planview_sub_region_id', 'Sales Subregion'),
                    Form::select('planview_sub_region_id', $pvRegions, Input::old('planview_sub_region_id', $customer->planview_sub_region_id), ['required']) .
                        $errors->first('planview_sub_region_id', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('markets', 'Markets'),
                    Form::select('markets', $markets, Input::old('markets', $customer->marketsById()), ['required', 'multiple', 'name' => 'markets[]']) .
                        $errors->first('markets', '<span class="label label-danger">:message</span>'),
                    null,
                    3
                ) }}

                {{ ControlGroup::generate(
                    Form::label('competitors', 'Competitors'),
                    Form::select('competitors', $competitors, Input::old('competitors', $customer->competitorsById()), ['multiple', 'name' => 'competitors[]']) .
                        $errors->first('competitors', '<span class="label label-danger">:message</span>'),
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
