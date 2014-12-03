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

    <nav class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">
      <ul class="nav navmenu-nav">
        <li class="active"><a href="./">Slide in</a></li>
        <li><a href="../navmenu-push/">Push</a></li>
        <li><a href="../navmenu-reveal/">Reveal</a></li>
        <li><a href="../navbar-offcanvas/">Off canvas navbar</a></li>
      </ul>
      <ul class="nav navmenu-nav">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu navmenu-nav">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      @yield('content')
    </div><!-- /.container -->
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/admin']) }}
  </body>
</html>
