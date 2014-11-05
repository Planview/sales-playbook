module.exports = function (grunt) {
    'use strict';

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    unixNewlines: true,
                    sourcemap: 'auto',
                    style: 'nested'
                },
                files: [{
                    expand: true,
                    cwd: 'public/scss',
                    src: ['*.scss'],
                    dest: 'public/css',
                    ext: '.css'
                }]
            }
        }
    });
};
