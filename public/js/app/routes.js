define([
    'angular',
    'text!./views/index.tmpl.html',
    'ui-router',
    './services/documents'
], function (angular, homeTemplate) {
    'use strict';

    return angular.module('salesResourceApp.routes', [
            'ui.router',
            'salesResourceApp.services.documents'
        ])
        .config(['$stateProvider', '$urlRouterProvider',
            function ($stateProvider, $urlRouterProvider) {
                $stateProvider.state('/', {
                    url: '/',
                    template: homeTemplate,
                    controller: 'PlaybookCtrl',
                    resolve: {
                        'documents': ['Document', function (Document) {
                            return Document.getList();
                        }]
                    }
                });
                $urlRouterProvider.otherwise('/');
        }]);
});
