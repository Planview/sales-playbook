@extends('admin.layout')

@section('title')
{{ $kickoff->name }} Sales Kickoff: Pages
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.kickoffs.pages.create', $kickoff->id) }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Page</a>
        <h1>{{ $kickoff->name }} Sales Kickoff: Pages</h1>
    </header>

    {{-- $pages->links() --}}

    @if ($pages->isEmpty())
        <p class="lead">There were no <b>Pages</b> found.</p>
    @else
        <ul class="list-group">
            @foreach ($pages as $page)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $page->slug }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.kickoffs.pages.create', $kickoff->id, $page->id)) }}

                </li>
            @endforeach
        </ul>
    @endif

    {{-- $pages->links() --}}
@stop
