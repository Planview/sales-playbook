define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.planviewRegions', [
            'restangular'
        ])
        .factory('PlanviewRegion', ['Restangular', function (Restangular) {
            return Restangular.service('planview-regions');
        }]);
});
