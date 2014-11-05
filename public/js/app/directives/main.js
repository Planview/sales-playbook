define([
    'angular',
    './model-fix',
    './playbook-select',
    './playbook-select-multiple',
    './pagination'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.directives', [
        'salesResourceApp.directives.salesModelFix',
        'salesResourceApp.directives.playbookSelect',
        'salesResourceApp.directives.playbookSelectMultiple',
        'salesResourceApp.directives.pagination',
    ]);
});
