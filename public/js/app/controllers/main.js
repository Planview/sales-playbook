define([
    'angular',
    './playbook-ctrl'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.controllers', [
        'salesResourceApp.controllers.PlaybookCtrl'
    ]);
});
