module.exports = function(grunt) {
  'use strict';

  // Project configuration.
  grunt.initConfig({
    mincss: {
      compress: {
        files: {
          'public/css/built.css': [
            'public/css/bootstrap.min.css',
            'public/css/bootstrap-responsive.min.css',
            'public/css/custom.css'
          ]
        }
      }
    },
    min: {
      dist: {
        src: [
          'public/js/jquery.js',
          'public/js/bootstrap.min.js',
          'public/js/fitvid.js',
          'public/js/lazyload.js'
        ],
        dest: 'public/js/built.js'
      }
    },
    watch: {
      files: ['public/css/*', 'public/js/*'],
      tasks: 'default'
    }
  });

  grunt.loadNpmTasks('grunt-contrib-mincss');

  // Default task.
  grunt.registerTask('default', 'min mincss');

};
