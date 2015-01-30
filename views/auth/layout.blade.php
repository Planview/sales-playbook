<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title', 'Login')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ avenir() }}
        {{ HTML::style('css/auth.css') }}
        {{ HTML::script('bower_components/modernizr/modernizr.js') }}
    </head>
</head>
<body>
    <div class="auth-container">
        <h1 class="pv-logo">Planview</h1>
        <div class="auth-body well">@yield('body')</div>
    </div>

    {{ livereload() }}
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/auth.js']) }}
</body>
</html>
