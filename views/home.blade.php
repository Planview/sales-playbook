<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Planview Sales Site</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ avenir() }}
        {{ HTML::style('css/auth.css') }}
        {{ HTML::script('bower_components/modernizr/modernizr.js') }}
    </head>
</head>
<body>
    <div class="container home-container">
        <h1 class="pv-logo pv-logo-lg">Planview</h1>
        {{ $content }}
    </div>

    {{ livereload() }}
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/auth.js']) }}
</body>
</html>
