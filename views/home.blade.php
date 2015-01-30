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
<body class="{{{ $bodyClass }}}">
    @if (Session::has('message'))
        <div class="container">
            <div class="alert alert-info alert-dismissable">
                <button class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{{ Session::get('message') }}}</p>
            </div>
        </div>
    @endif
    <div class="container home-container">
        <h1 class="pv-logo pv-logo-lg">Planview</h1>
        {{ $content }}
    </div>

    {{ livereload() }}
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/auth.js']) }}
</body>
</html>
