@extends('admin.layout')

@section('title')
All Documents
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.documents.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Document</a>
        <h1>All Documents</h1>
    </header>

    {{ $documents->links() }}

    @if ($documents)
        <ul class="list-group">
            @foreach ($documents as $document)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $document->title }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.documents.show', $document->id)) }}
                    {{ Form::inline(['route' => ['admin.documents.destroy', $document->id], 'method' => 'delete', 'class' => 'form-button']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No <b>Documents</b> found.</p>
    @endif

    {{ $documents->links() }}
@stop
