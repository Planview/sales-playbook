define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.customers', [
            'restangular'
        ])
        .factory('Customer', ['Restangular', function (Restangular) {
            return Restangular.service('customers');
        }]);
});
