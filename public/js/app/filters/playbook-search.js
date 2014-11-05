define([
    'angular',
    'lodash'
], function (angular, _) {
    'use strict';

    return angular.module('salesResourceApp.filters.playbookSearch', [])
        .filter('playbookSearch', function () {
            var lastObject = -1,
                lastInput = -1,
                lastResponse;

            return function (input, object) {
                if (_.isEqual(lastObject, object) && _.isEqual(lastInput, input)) return lastResponse;
                var list = input,
                    compare = {},
                    getId = function (obj) { return {id: obj.id}; };

                if (_.has(object, 'customer') && !!object.customer) {
                    compare.customer_verbose.id = object.customer.id;
                } else {
                    compare.customer_verbose = {}
                }

                if (_.has(object, 'markets') && !!object.markets.length) {
                    compare.customer_verbose.markets = _.map(object.markets, getId);
                }
                if (_.has(object, 'competitors') && !!object.competitors.length) {
                    compare.customer_verbose.competitors = _.map(object.competitors, getId);
                }
                if (_.has(object, 'industry') && !!object.industry) {
                    compare.customer_verbose.industry_id = object.industry.id;
                }
                if (_.has(object, 'operating_region') && !! object.operating_region) {
                    compare.customer_verbose.operating_region_id = object.operating_region.id;
                }
                if (_.has(object, 'document_type') && !!object.document_type) {
                    compare.document_type_id = object.document_type.id;
                }

                lastResponse = _.where(input, compare);
                lastObject = object;
                lastInput = input;
                return lastResponse;
            };
        });
});
