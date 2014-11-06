define([
    'angular',
    'ui-bootstrap',
    './config',
    './routes',
    './controllers/main',
    './directives/main',
    './filters/main',
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp', [
        'salesResourceApp.config',
        'salesResourceApp.routes',
        'salesResourceApp.controllers',
        'salesResourceApp.directives',
        'salesResourceApp.filters',
        'ui.bootstrap'
    ]);
});
