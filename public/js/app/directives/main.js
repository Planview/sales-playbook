define([
    'angular',
    './playbook-select',
    './playbook-select-multiple',
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.directives', [
        'salesResourceApp.directives.playbookSelect',
        'salesResourceApp.directives.playbookSelectMultiple',
    ]);
});
