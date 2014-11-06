define([
    'angular',
    'lodash'
], function (angular, _) {
    'use strict';

    return angular.module('salesResourceApp.filters.playbookSearch', [])
        .filter('playbookSearch', function () {
            var lastResponse,
                sanitize;

            sanitize = function (object) {
                if (!_.isPlainObject(object)) {
                    return object;
                }

                _.forEach(object, function (val, key, obj) {
                    if (_.isObject(val)) {
                        sanitize(val);
                    }

                    if (_.isNull(val) || _.isObject(val) && _.isEmpty(val)) {
                        delete obj[key];
                    }

                    if (_.isArray(obj[key])) {
                        obj[key] = _.map(val, function (idVal) { return {id: idVal}; });
                    }
                });
            };

            return function (input, object) {
                var newObj = _.cloneDeep(object);
                sanitize(newObj);

                if (_.isEmpty(newObj)) {
                    return input;
                }

                var newResponse = _.where(input, newObj);

                if (!_.isEqual(newResponse, lastResponse)) {
                    lastResponse = newResponse;
                }

                return lastResponse;
            };
        });
});
