define([
    'angular',
    'text!./views/index.tmpl.html',
    'ui-router',
    './services/documents'
], function (angular, homeTemplate) {
    'use strict';

    return angular
        .module('salesResourceApp.routes', [
            'ui.router',
            'salesResourceApp.services.documents'
        ])
        .run(['$rootScope', '$state', '$stateParams',
            function ($rootScope, $state, $stateParams) {
                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
            }])
        .config(['$stateProvider', '$urlRouterProvider',
            function ($stateProvider, $urlRouterProvider) {
                $stateProvider.state('home', {
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
