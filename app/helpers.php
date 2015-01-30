<?php

function livereload($port = 35729, $host = '127.0.0.1') {
    if (in_array(App::environment(), ['local', 'homestead'])) {
        return HTML::script("http://{$host}:{$port}/livereload.js?snipver=1");
    }

    return null;
}


function avenir() {
    return HTML::style('http://fast.fonts.net/cssapi/63831bdf-368a-400e-b051-d6f981441c12.css');
}
