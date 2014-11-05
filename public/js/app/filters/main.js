define([
    'angular',
    './playbook-search',
    './paging'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.filters', [
        'salesResourceApp.filters.playbookSearch',
        'salesResourceApp.filters.paging'
    ]);
});
