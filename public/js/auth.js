require.config({
    paths: {
        jquery: '../bower_components/jquery/dist/jquery.min',
        bootstrap: '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap'
    },
    shim: {
        bootstrap: {
            deps: ['jquery']
        }
    }
});

require(['jquery', 'bootstrap'], function ($) {
    'use strict';

    $.noop();
});
