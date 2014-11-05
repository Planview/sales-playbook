define([
    'angular',
    'lodash',
    'text!./pagination.tmpl.html'
], function (angular, _, template) {
    'use strict';

    angular.module('salesResourceApp.directives.pagination', [])
        .directive('srcPagination', function () {
            return {
                restrict: 'AC',
                template: template,
                scope: {
                    collection: '=',
                    perPage: '=',
                    page: '='
                },
                controller: ['$scope', function ($scope) {
                    $scope.numberResults = function () {
                        return $scope.collection.length;
                    };

                    $scope.numPages = function () {
                        return Math.ceil($scope.numberResults() / $scope.perPage);
                    };

                    $scope.pageStartIndex = function () {
                        return $scope.perPage * ($scope.page - 1);
                    };

                    $scope.pageEndIndex = function () {
                        return Math.min($scope.numberResults() - 1,
                            $scope.perPage * ($scope.page) - 1);
                    };

                    $scope.pageNext = function () {
                        if (!$scope.isLastPage()) {
                            $scope.page += 1;
                        }
                    };

                    $scope.pagePrevious = function () {
                        if (!$scope.isFirstPage()) {
                            $scope.page -= 1;
                        }
                    };

                    $scope.goToPage = function (pageNum) {
                        $scope.page = pageNum;
                    };

                    $scope.$watch('perPage', function (newValue, oldValue) {
                        $scope.page = Math.min($scope.page, $scope.numPages());
                    });

                    $scope.$watch('collection', function (newValue, oldValue) {
                        $scope.page = Math.min($scope.page, $scope.numPages());
                    });

                    $scope.pagingArray = function () {
                        return _.range(1, $scope.numPages() + 1);
                    };

                    $scope.isFirstPage = function () {
                        return $scope.page == 1;
                    };

                    $scope.isLastPage = function () {
                        return $scope.page == $scope.numPages();
                    };

                    $scope.isCurrentPage = function (pageNum) {
                        return $scope.page == pageNum;
                    };
                }]
            }
        })
});
