/* global module */

module.exports = function (grunt) {
    'use strict';

    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

    var appConfig = {
        app: 'public',
        dist: 'html'
    };

    grunt.initConfig({
        paths: appConfig,
        sass: {
            dev: {
                options: {
                    unixNewlines: true,
                    sourcemap: 'auto',
                    style: 'nested',
                    loadPath: 'public/bower_components'
                },
                files: [{
                    expand: true,
                    cwd: '<%= paths.app %>/scss',
                    src: ['*.scss'],
                    dest: '<%= paths.app %>/css',
                    ext: '.css'
                }]
            }
        },
        jshint: {
            options: {
                jshintrc: true,
                reporter: require('jshint-stylish')
            },
            all: [
                'Gruntfile.js',
                '<%= paths.app %>/js/**/*.js',
                '!<%= paths.app %>/js/tests/**/*.js'
            ],
            test: {
                options: {
                    jshintrc: '<%= paths.app %>/js/test/.jshintrc'
                },
                src: ['test/spec/{,*/}*.js']
            }
        },
        watch: {
            scripts: {
                files: '<%= paths.app %>/js/**/*.js',
                tasks: ['newer:jshint:all']
            },
            sass: {
                files: '<%= paths.app %>/scss/**/*.scss',
                tasks: ['sass:dev']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    '**/*.php',
                    '!vendor/**/*.php',
                    'public/css/*.css',
                    'public/js/**/*.js'
                ]
            }
        },
        phpunit: {
            options: {
                bin: 'vendor/bin/phpunit',
                configuration: 'phpunit.xml'
            },
            app: {
                dir: 'app/tests'
            }
        },
        clean: {
            dist: {
                files: [{
                    dot: true,
                    src: [
                        '.tmp',
                        '<%= paths.dist %>/{,*/}*',
                        '!<%= paths.dist %>/.git*'
                    ]
                }]
            },
            server: '.tmp'
        },
        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= paths.app %>/images',
                    src: '{,*/}*.{png,jpg,jpeg,gif}',
                    dest: '<%= paths.dist %>/images'
                }]
            }
        },
    });

    grunt.registerTask('default', ['sass:dev', 'newer:jshint:all', 'watch']);
};
