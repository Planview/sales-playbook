<!DOCTYPE html>
<html lang="en" ng-app>
<head>
    <meta charset="UTF-8">
    <title>Sales Playbook</title>
    {{ HTML::style('css/main.css') }}
</head>
<body>
    <div class="container">
        <header class="page-header">
            <h1 class="text-center">Interactive Sales Playbook</h1>
        </header>
        <section ui-view></section>
    </div>
    {{ HTML::script('bower_components/requirejs/require.js', ['data-main' => '/js/main']) }}
</body>
</html>
