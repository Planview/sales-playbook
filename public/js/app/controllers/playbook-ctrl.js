define([
    'angular',
    'lodash',
    '../filters/main',
    '../services/documents',
    '../services/document-types',
    '../services/customers',
    '../services/competitors',
    '../services/industries',
    '../services/markets',
    '../services/operating-regions',
    '../services/planview-regions',
], function (angular, _) {
    'use strict';

    angular.module('salesResourceApp.controllers.PlaybookCtrl', [
            'salesResourceApp.filters',
            'salesResourceApp.services.documents',
            'salesResourceApp.services.documentTypes',
            'salesResourceApp.services.customers',
            'salesResourceApp.services.competitors',
            'salesResourceApp.services.industries',
            'salesResourceApp.services.markets',
            'salesResourceApp.services.operatingRegions',
            'salesResourceApp.services.planviewRegions',
        ])
        .controller('PlaybookCtrl', [
            '$scope',
            '$filter',
            'Document',
            'DocumentType',
            'Customer',
            'Competitor',
            'Industry',
            'Market',
            'OperatingRegion',
            'PlanviewRegion',
            function (
                    $scope,
                    $filter,
                    Document,
                    DocumentType,
                    Customer,
                    Competitor,
                    Industry,
                    Market,
                    OperatingRegion,
                    PlanviewRegion
                ) {
                var filteredResults;

                $scope.documents = Document.getList().$object;
                $scope.types = DocumentType.getList().$object;
                $scope.operatingRegions = OperatingRegion.getList().$object;
                $scope.planviewRegions = PlanviewRegion.getList().$object;
                $scope.markets = Market.getList().$object;
                $scope.industries = Industry.getList().$object;
                $scope.customers = Customer.getList().$object;
                $scope.competitors = Competitor.getList().$object;
                $scope.page = 1;
                $scope.perPage = 25;
                $scope.filter = {};
                $scope.searchText = '';

                $scope.filteredDocuments = function () {
                    var results;
                    results = $filter('playbookSearch')($scope.documents, $scope.filter);
                    results = $filter('filter')(results, $scope.searchText);

                    if (!_.isEqual(results, filteredResults)) {
                        filteredResults = results;
                    }
                    return filteredResults;
                };

                $scope.resetCategories = function () {
                    $scope.filter = {};
                    $scope.searchText = '';
                };
            }
        ]);
});
