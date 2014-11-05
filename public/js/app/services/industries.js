define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.industries', [
            'restangular'
        ])
        .factory('Industry', ['Restangular', function (Restangular) {
            return Restangular.service('industries');
        }]);
});
