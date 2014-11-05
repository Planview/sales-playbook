define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.markets', [
            'restangular'
        ])
        .factory('Market', ['Restangular', function (Restangular) {
            return Restangular.service('markets');
        }]);
});
