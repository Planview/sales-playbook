<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Kickoff 2015</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/63831bdf-368a-400e-b051-d6f981441c12.css"/>
    {{ HTML::style('css/kickoff-2015.css') }}

    {{ $page->styles }}
</head>
<body>
    <!--[if lt IE 10]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    {{ Navbar::withBrand('Sales Kickoff 2015', URL::route('kickoff.show', $kickoff->name))
      ->withContent(Navigation::links($kickoff->menuArray())->right()) }}

    {{ $page->html }}

    <footer class="site-footer">
      <div class="container">
        <p class="planview">
          <a href="//www.planview.com"><span class="planview-logo white">Planview</span></a>
        </p>
        <p class="copyright">&copy; 2015 Planview Inc., All Rights Reserved</p>
      </div>
    </footer>

    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/kickoff-2015.js']) }}
    {{ $page->scripts }}
</body>
</html>
