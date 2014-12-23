<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('css/admin.css'); }}
  </head>
  <body class="admin">

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <button type="button" class="navbar-toggle navmenu-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
          <span class="fa fa-caret-square-o-right"></span>
        </button>
        <a class="navbar-brand" href="#">Sales Playbook</a>
      </div>
    </nav>

    @include('admin.partials.sidebar')

    <div class="container-fluid">
      @yield('content')
    </div><!-- /.container -->
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/admin']) }}
  </body>
</html>
