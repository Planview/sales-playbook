@extends('admin.layout')

@section('title')
All Customers
@stop

@section('content')
    <header class="page-header">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add New Customer</a>
        <h1>All Customers</h1>
    </header>

    {{ $customers->links() }}

    @if ($customers)
        <ul class="list-group">
            @foreach ($customers as $customer)
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $customer->name }}</h4>
                    {{ Button::primary('Edit')->asLinkTo(route('admin.customers.show', $customer->id)) }}

                    {{ Form::inline(['route' => ['admin.customers.destroy', $customer->id], 'method' => 'delete', 'class' => 'form-button']) }}
                        {{ Button::danger('Delete')->submit() }}
                    {{ Form::close() }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="lead">No <b>Customers</b> found.</p>
    @endif

    {{ $customers->links() }}
@stop
