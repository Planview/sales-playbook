require.config({
    paths: {
        'jquery': '../bower_components/jquery/dist/jquery',
        'bootstrap': '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap',
        'jasny': '../bower_components/jasny-bootstrap/dist/js/jasny-bootstrap'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery']
        },
        'jasny': {
            deps: ['jquery']
        }
    }
});

require(['bootstrap', 'jasny']);
