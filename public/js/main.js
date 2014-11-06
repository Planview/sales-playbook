require.config({
    paths: {
        'text': '../bower_components/requirejs-text/text',
        'angular': '../bower_components/angular/angular',
        'restangular': '../bower_components/restangular/dist/restangular',
        'jquery': '../bower_components/jquery/dist/jquery',
        'lodash': '../bower_components/lodash/dist/lodash',
        'bootstrap': '../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap',
        'ui-bootstrap': '../bower_components/angular-ui-bootstrap-bower/ui-bootstrap-tpls'
    },
    shim: {
        'angular': {
            exports: 'angular',
            deps: ['jquery']
        },
        'restangular': {
            deps: ['angular', 'lodash']
        },
        'lodash': {
            exports: '_'
        },
        'bootstrap': {
            deps: ['jquery']
        },
        'ui-bootstrap': {
            deps: ['jquery', 'bootstrap', 'angular']
        }
    },
    priority: ['angular']
});
window.name = 'NG_DEFER_BOOTSTRAP!';
require([
  'angular',
  'app/app',
  'bootstrap'
], function(angular, app) {
  'use strict';

  /* jshint ignore:start */
  var $html = angular.element(document.getElementsByTagName('html')[0]);
  /* jshint ignore:end */
  angular.element().ready(function() {
    angular.resumeBootstrap([app.name]);
  });
});
