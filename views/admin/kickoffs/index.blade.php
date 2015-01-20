@extends('admin.layout')

@section('title')
Sales Kickoff Sites
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.kickoffs.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New</a>
        <h1>Sales Kickoff Sites</h1>
    </header>

    {{ $kickoffs->links() }}

    @if (!$kickoffs->isEmpty())
        <ul class="list-group">
            @foreach ($kickoffs as $kickoff)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $kickoff->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.kickoffs.show', $kickoff->id)) }}
                    {{ Form::inline(['route' => ['admin.kickoffs.destroy', $kickoff->id], 'class' => 'form-button', 'method' => 'delete']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">There where no <b>Sales Kickoff Sites</b> found.</p>
    @endif

    {{ $kickoffs->links() }}
@stop
