/*!
 * WBootstrap's Gulpfile
 * Adapted from Bootstrap's Gruntfile
 * Bootstrap documentation largely removed
 * http://getbootstrap.com
 * Copyright 2013-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */


  var gulp = require('gulp');
  var gutil = require('gulp-util');
  // Note: gulp-load-tasks looks at package.json, and brings everything in like:
  // gulp-less => tasks.less
  var gulpLoadTasks = require("gulp-load-plugins");
  var tasks = gulpLoadPlugins({scope: ["devDependencies"]});

  // Convenience function, since notification isn't really a task.
  var notify = tasks.notify;
  var pkg = require('./package.json');

  var config = {
    meta : {
      banner: '/*!\n' +
            ' * WB-Bootstrap v<%= pkg.version %> (<%= pkg.homepage %>)\n' +
            ' * Copyright 2014-' + gutil.date(new Date(), "yyyy") + ' <%= pkg.author %>\n' +
            ' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>)\n' +
            ' */\n',
      jqueryCheck: 'if (typeof jQuery === \'undefined\') { throw new Error(\'Bootstrap\\\'s JavaScript requires jQuery\') }\n\n',
    },
    paths : {
      scripts : {
        src: [
          'js/transition.js',
          'js/alert.js',
          'js/button.js',
          'js/carousel.js',
          'js/collapse.js',
          'js/dropdown.js',
          'js/modal.js',
          'js/tooltip.js',
          'js/popover.js',
          'js/scrollspy.js',
          'js/tab.js',
          'js/affix.js',
          'js/plugins.js',
          'js/script.js'
        ],
        dest : {
          parent : "./dist/js/",
          min : pkg.name + ".min.js",
          unmin : pkg.name + ".js"
        }
      },
      css : {
        src : ["less/*.less"],
        dest : {
          parent : "./dist/css/",
          min : pkg.name + ".min.css",
          unmin : pkg.name + ".css"
        }
      }
    }
  };

  // Config-y auto-tasks from Gruntfile:
  // clean
  gulp.task('clean', function(){
    return gulp.src(["dist/js", "dist/css", "dist/img", "dist/fonts"], { read: false })
      .pipe(tasks.clean({force: true}));
  });
  // combined:
    // jshint
    // jscs
    // csslint
    // concat
    // uglify
    // less
    // cssmin
    // usebanner
    // csscomb
    // copy
  // qunit - unused
  // connect - unused
  // jekyll - unused
  // jade - unused
  // validation - unused
  
  // watch
  gulp.task("watch", function(){
    gulp.watch(config.paths.scripts.src, ['dist-js']);
    gulp.watch(config.paths.css.src, ['dist-css', 'dist-img', 'dist-fonts']);
  });
  // sed - not used
  // exec - not used
  // grunt.registerTask('update-shrinkwrap', ['exec:npmUpdate', 'exec:npmShrinkWrap', '_update-shrinkwrap']);

  // TASKS:
  // dist-js
  gulp.task('dist-js', function() {
    gulp.src("js/vendor/*.js", {base : "./js/"})
      .pipe(gulp.dest(config.paths.scripts.dest.parent));
    return gulp.src(config.paths.scripts.src)
      .pipe(tasks.concat(config.paths.scripts.dest.unmin))
      .pipe(tasks.header(config.meta.banner + "\n" + config.meta.jqueryCheck, { pkg : pkg }))
      .pipe(gulp.dest(config.paths.scripts.dest.parent))
      .pipe(tasks.rename({suffix: '.min'}))
      .pipe(tasks.jscs(__dirname + '/js/.jscs.json').on('error', function(message){
          gutil.log(unescape(message)); gutil.beep();
        })
      )
      .pipe(tasks.jshint('./js/.jshintrc'))
      .pipe(tasks.jshint.reporter('default'))
      .pipe(tasks.uglify().on('error', gutil.log))
      .pipe(gulp.dest(config.paths.scripts.dest.parent))
      .pipe(notify({ message: 'JS Compiling Complete' }));
  });
  // dist-css
  gulp.task('dist-css', function() {
    return gulp.src("less/bootstrap.less")
      .pipe(
        tasks.less({
          paths: ["less/bootstrap.less"],
          sourceMap: true
        })
      )
      .on('error', function(message){
          gutil.log(unescape(message)); gutil.beep();
        })
      .pipe(tasks.rename(config.paths.css.dest.unmin))
      .pipe(tasks.autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
      .pipe(tasks.csscomb('less/.csscomb.json'))
      .pipe(tasks.csslint('less/.csslintrc'))
      .pipe(tasks.csslint.reporter())
      .pipe(tasks.header(config.meta.banner, { pkg : pkg }))
      .pipe(gulp.dest(config.paths.css.dest.parent))
      .pipe(tasks.rename(config.paths.css.dest.min))
      .pipe(tasks.cssmin())
      .pipe(gulp.dest(config.paths.css.dest.parent))
      .pipe(notify({ message: 'CSS Compiling Complete' }));
  });

  gulp.task('dist-fonts', function(){
    return gulp.src("fonts/*", {base : "./fonts/"})
      .pipe(tasks.newer('dist/fonts'))
      .pipe(gulp.dest('dist/fonts'));
  });

  gulp.task('dist-img', function(){
    return gulp.src(['img/*.jpg', 'img/*.png'])
      .pipe(tasks.newer('dist/img'))
      .pipe(tasks.imagemin())
      .pipe(gulp.dest('dist/img'));
  });
  // dist-docs
  // dist (parent)
  gulp.task('dist', ['clean', 'dist-css', 'dist-js', 'dist-img', 'dist-fonts']);
  // default
  gulp.task('default', ['clean', 'dist']);
