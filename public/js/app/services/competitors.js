define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.competitors', [
            'restangular'
        ])
        .factory('Competitor', ['Restangular', function (Restangular) {
            return Restangular.service('competitors');
        }]);
});
