/* global module */

module.exports = function (grunt) {
    'use strict';

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        sass: {
            dev: {
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
        },
        jshint: {
            options: {
                jshintrc: true
            },
            all: ['Gruntfile.js', 'public/js/**/*.js']
        },
        watch: {
            scripts: {
                files: '**/*.js',
                tasks: ['jshint:all']
            },
            sass: {
                files: ['**/*.scss', '**/*.sass'],
                task: ['sass:dev']
            }
        }
    });

    grunt.registerTask('default', ['sass:dev', 'jshint:all', 'watch']);
};
