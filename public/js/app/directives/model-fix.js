define([
    'angular'
], function (angular) {
    'use strict';

    return angular.module('salesResourceApp.directives.salesModelFix', [])
        .directive('srcModelFix', function () {
            return {
                require: 'ngModel',
                restrict: 'AC',
                link: function(scope, element, attrs, ngModel) {
                    ngModel.$parsers.push(function(value) {
                        if ( value === null ) {
                            value = '';
                        }
                        return value;
                    });
                }
            };
        });
});
