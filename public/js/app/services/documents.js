define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.documents', [
            'restangular'
        ])
        .factory('Document', ['Restangular', function (Restangular) {
            return Restangular.service('documents');
        }]);
});
