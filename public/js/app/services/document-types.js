define([
    'angular',
    'restangular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.services.documentTypes', [
            'restangular'
        ])
        .factory('DocumentType', ['Restangular', function (Restangular) {
            return Restangular.service('document-types');
        }]);
});
