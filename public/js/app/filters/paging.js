define([
    'angular',
    'lodash'
], function (angular, _) {
    'use strict';

    return angular.module('salesResourceApp.filters.paging', [])
        .filter('paging', function () {
            return function (input, options) {
                var page = options.page || 1,
                    perPage = options.perPage || 25,
                    inLength = input.length,
                    lastElem = Math.min((page) * perPage, inLength),
                    numElems = lastElem === inLength ?
                        (inLength % perPage) || perPage : perPage;

                return _(input).first(lastElem).last(numElems).value();
            };
        });
});
