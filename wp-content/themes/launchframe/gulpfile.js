////// LAUNCH!
////
//



var gulp = require('gulp'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  scsslint = require('gulp-scss-lint'),
  watch = require('gulp-watch'),
  gulpLoadPlugins = require("gulp-load-plugins"),
  tasks = gulpLoadPlugins({scope: ["devDependencies"]}),
  gutil = require('gulp-util'),
  livereload = require('gulp-livereload'),
  cssGlobbing = require('gulp-css-globbing'),
  babel = require('gulp-babel'),
  eslint = require('gulp-eslint'),
  replace = require('gulp-replace'),
  del = require('del'),
  notify = tasks.notify;

gulp.task('dist-sass', function () {
    gulp.src('./assets/src/scss/*.scss')
      .pipe(scsslint({
        'config': 'scss-lint.yml',
      }));
    gulp.src('./assets/src/scss/application.scss')
	  .pipe(tasks.sourcemaps.init())
	    .pipe(tasks.sass())
	    .pipe(tasks.autoprefixer('last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
	    .pipe(gulp.dest('./assets/dist/css'))
      .pipe(tasks.rename({suffix: '.min'}))
      .pipe(tasks.cssmin())
	  .pipe(tasks.sourcemaps.write())
	  .pipe(gulp.dest('./assets/dist/css'));
});

gulp.task('dist-js', function () {

	gulp.src('./assets/src/js/script.js')
      .pipe(sourcemaps.init())
      .pipe(tasks.concat('./assets/dist/js/script.js'))
      .pipe(eslint())
      .pipe(babel())
      .pipe(gulp.dest('./'))
      .pipe(tasks.rename({suffix: '.min'}))
      .pipe(tasks.uglify())
      .pipe(eslint.format())
      .pipe(gulp.dest('./'))
      .pipe(sourcemaps.write('.'))
      .pipe(livereload())
      .on('error', function(message){
        console.log(message);
      });
	gulp.src('./assets/vendor/slick.js/slick/slick.min.js')
    .pipe(tasks.concat('./assets/dist/js/plugins.js'))
    .pipe(gulp.dest('./'))

});

gulp.task('dist-img', function(){
	return gulp.src(['assets/src/img/*.jpg', 'assets/src/img/*.png', 'assets/src/img/*.svg'])
	  .pipe(tasks.newer('assets/dist/img'))
	  .pipe(tasks.imagemin())
	  .pipe(gulp.dest('assets/dist/img'));
});

gulp.task('watch', function () {
	livereload.listen();
	watch('assets/src/**/*.js', function () {
		gulp.start('dist-js');
	    livereload.changed();
	});
	watch('assets/src/**/*.scss', function () {
		gulp.start('dist-sass');
		livereload.changed();
	});
});
