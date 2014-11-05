define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.config', ['restangular'])
        .config(['RestangularProvider', function (RestangularProvider) {
            RestangularProvider.setBaseUrl('/api');
        }]);
});
