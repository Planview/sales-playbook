define([
    'angular',
    'text!./playbook-select.tmpl.html',
], function (angular, template) {
    'use strict';

    return angular.module('salesResourceApp.directives.playbookSelect', [])
        .directive('srcPlaybookSelect', function () {
            return {
                scope: {
                    id: '@',
                    collectionLabel: '@',
                    itemLabel: '@',
                    itemValue: '@',
                    collection: '=',
                    collectionModel: '='
                },
                restrict: 'A',
                template: template,
                replace: true
            };
        });
});
