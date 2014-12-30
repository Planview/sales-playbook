<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    @section('styles')
      {{ HTML::style('css/admin.css') }}
    @show
  </head>
  <body class="admin">
    @include('admin.partials.flash')
    @include('admin.partials.navbar')
    @include('admin.partials.sidebar')

    <div class="container-fluid">
      @yield('content')
    </div><!-- /.container -->

    @section('scripts')
      {{ livereload() }}
      {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/admin']) }}
    @show
  </body>
</html>
