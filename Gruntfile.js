module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        jshint: {
            all: ['js/tests.js', 'js/script.js']
        },
        qunit: {
            files: ['tests.html']
        }
    });

    // Load plugin
    grunt.loadNpmTasks('grunt-contrib-qunit');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    // Task to run tests
    grunt.registerTask('test', ['qunit']);
    grunt.registerTask('jshint', ['jshint']);
    grunt.registerTask('default', ['qunit', 'jshint']);
};
