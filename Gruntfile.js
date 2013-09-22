/* jshint node: true */

module.exports = function(grunt) {
  "use strict";

  // Project configuration.
  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*!\n' +
              '* Launchframe v<%= pkg.version %> by @Whiteboardis dev team\n' +
              '* Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
              '*\n' +
              '* Designed and built for developers by developers.\n' +
              '*/\n',
    jqueryCheck: 'if (!jQuery) { throw new Error(\"<%= pkg.name %> requires jQuery\") }\n\n',

    // Task configuration.
    clean: {
      dist: ['dist']
    },

    jshint: {
      options: {
        jshintrc: 'js/.jshintrc'
      },
      gruntfile: {
        src: 'Gruntfile.js'
      },
      src: {
        src: [
        'js/plugins.js',
        'js/script.js'
        ]
      },
      test: {
        src: ['js/tests/unit/*.js']
      }
    },

    concat: {
      options: {
        banner: '<%= banner %><%= jqueryCheck %>',
        stripBanners: false
      },
      launchframe: {
        src: [
          'js/plugins.js',
          'js/script.js'
        ],
        dest: 'js/build.js'
      }
    },

    uglify: {
      options: {
        banner: '<%= banner %>'
      },
      launchframe: {
        src: ['<%= concat.launchframe.dest %>'],
        dest: 'js/build.min.js'
      }
    },

    recess: {
      options: {
        compile: true,
        banner: '<%= banner %>'
      },
      launchframe: {
        src: ['less/style.less'],
        dest: 'css/style.css'
      },
      min: {
        options: {
          compress: true
        },
        src: ['less/style.less'],
        dest: 'css/style.min.css'
      }
    },

    // copy: {
    //   fonts: {
    //     expand: true,
    //     src: ["fonts/*"],
    //     dest: 'dist/'
    //   }
    // },

    // qunit: {
    //   options: {
    //     inject: 'js/tests/unit/phantom.js'
    //   },
    //   files: ['js/tests/*.html']
    // },

    connect: {
      server: {
        options: {
          port: 3000,
          base: '.'
        }
      }
    },

    // jekyll: {
    //   docs: {}
    // },

    // validation: {
    //   options: {
    //     reset: true
    //   },
    //   files: {
    //     src: ["_gh_pages/**/*.html"]
    //   }
    // },

    watch: {
      src: {
        files: '<%= jshint.src.src %>',
        tasks: ['jshint:src', 'dist']
      },
      // test: {
      //   files: '<%= jshint.test.src %>',
      //   tasks: ['jshint:test', 'qunit']
      // },
      recess: {
        files: 'less/*.less',
        tasks: ['recess']
      }
    }
  });


  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  // grunt.loadNpmTasks('grunt-contrib-qunit');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-html-validation');
  grunt.loadNpmTasks('grunt-jekyll');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('browserstack-runner');

  // Docs HTML validation task
  // grunt.registerTask('validate-html', ['jekyll', 'validation']);

  // Test task.
  // var testSubtasks = ['dist-css', 'jshint', 'qunit', 'validate-html'];
  // Only run BrowserStack tests under Travis
  // if (process.env.TRAVIS) {
  //   // Only run BrowserStack tests if this is a mainline commit in twbs/bootstrap, or you have your own BrowserStack key
  //   if ((process.env.TRAVIS_REPO_SLUG === 'twbs/bootstrap' && process.env.TRAVIS_PULL_REQUEST === 'false') || process.env.TWBS_HAVE_OWN_BROWSERSTACK_KEY) {
  //     testSubtasks.push('browserstack_runner');
  //   }
  // }
  // grunt.registerTask('test', testSubtasks);

  // JS distribution task.
  grunt.registerTask('dist-js', ['concat', 'uglify']);

  // CSS distribution task.
  grunt.registerTask('dist-css', ['recess']);

  // Fonts distribution task.
  // grunt.registerTask('dist-fonts', ['copy']);

  // Full distribution task.
  // grunt.registerTask('dist', ['clean', 'dist-css', 'dist-fonts', 'dist-js']);
  grunt.registerTask('dist', ['dist-css', 'dist-js']);

  // Default task.
  // grunt.registerTask('default', ['test', 'dist', 'build-customizer']);
  grunt.registerTask('default', ['dist']);

  // task for building customizer
  // grunt.registerTask('build-customizer', 'Add scripts/less files to customizer.', function () {
  //   var fs = require('fs')

  //   function getFiles(type) {
  //     var files = {}
  //     fs.readdirSync(type)
  //       .filter(function (path) {
  //         return type == 'fonts' ? true : new RegExp('\\.' + type + '$').test(path)
  //       })
  //       .forEach(function (path) {
  //         return files[path] = fs.readFileSync(type + '/' + path, 'utf8')
  //       })
  //     return 'var __' + type + ' = ' + JSON.stringify(files) + '\n'
  //   }

  //   var customize = fs.readFileSync('customize.html', 'utf-8')
  //   var files = getFiles('js') + getFiles('less') + getFiles('fonts')
  //   fs.writeFileSync('assets/js/raw-files.js', files)
  // });
};