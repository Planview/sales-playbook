define([
    'angular',
    'text!./playbook-select-multiple.tmpl.html',
], function (angular, template) {
    'use strict';

    return angular.module('salesResourceApp.directives.playbookSelectMultiple', [])
        .directive('srcPlaybookSelectMultiple', function () {
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
