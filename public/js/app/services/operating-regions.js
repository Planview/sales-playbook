define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.operatingRegions', [
            'restangular'
        ])
        .factory('OperatingRegion', ['Restangular', function (Restangular) {
            return Restangular.service('operating-regions');
        }]);
});
