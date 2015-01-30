@extends('auth.layout')

@section('title')
Change Password
@stop

@section('body')
    {{ Form::open(['action' => 'UsersController@doChangePassword']) }}
        <fieldset>
            <legend>Change Your Password</legend>
            <div class="form-group">
                <label for="password">New Password</label>
                <input class="form-control" placeholder="New Password" type="password" name="password" id="password">
                {{ $errors->first('password', '<span class="label label-danger">:message</span>')}}
            </div>
            <div class="form-group">
                <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
                {{ $errors->first('password_confirmation', '<span class="label label-danger">:message</span>')}}
            </div>

            @if (Session::get('error'))
                <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
            @endif

            @if (Session::get('notice'))
                <div class="alert">{{{ Session::get('notice') }}}</div>
            @endif

            <div class="form-actions form-group">
                <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
            </div>
        </fieldset>
    {{ Form::close() }}
@stop
