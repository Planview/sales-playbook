define([
    'angular',
    'lodash',
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
                    Document,
                    DocumentType,
                    Customer,
                    Competitor,
                    Industry,
                    Market,
                    OperatingRegion,
                    PlanviewRegion
                ) {
                $scope.documents = Document.getList().$object;
                $scope.types = DocumentType.getList().$object;
                $scope.operatingRegions = OperatingRegion.getList().$object;
                $scope.planviewRegions = PlanviewRegion.getList().$object;
                $scope.markets = Market.getList().$object;
                $scope.industries = Industry.getList().$object;
                $scope.customers = Customer.getList().$object;
                $scope.competitors = Competitor.getList().$object;
                $scope.page = 1;
                $scope.perPage = 5;
                $scope.filter = {};
                $scope.filterArray = {};
                $scope.search = {};

                $scope.resetCategories = function () {
                    $scope.filter = {};
                    $scope.search = {};
                };
            }
        ]);
});
