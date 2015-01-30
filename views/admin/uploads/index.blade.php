@extends('admin.layout')

@section('title')
All Uploads
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.uploads.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Upload</a>
        <h1>All Uploads</h1>
    </header>

    {{ $uploads->links() }}

    @if ($uploads->isEmpty())
        <p class="lead">There were no <b>Uploads</b> found.</p>
    @else
        <ul class="list-group">
            @foreach ($uploads as $upload)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $upload->name }}</h4>
                    {{ $upload->fileUrl() }}
                </li>
            @endforeach
        </ul>
    @endif

    {{ $uploads->links() }}

@stop
