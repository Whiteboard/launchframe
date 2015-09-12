////// LAUNCH!
////
//

var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	watch = require('gulp-watch'),
	gulpLoadPlugins = require("gulp-load-plugins"),
	tasks = gulpLoadPlugins({scope: ["devDependencies"]}),
	gutil = require('gulp-util'),
	livereload = require('gulp-livereload'),
	notify = tasks.notify;

gulp.task('dist-sass', function () {
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
      .pipe(tasks.concat('./assets/dist/js/script.js'))
      .pipe(gulp.dest('./'))
      .pipe(tasks.rename({suffix: '.min'}))
      .pipe(tasks.uglify())
      .pipe(gulp.dest('./'));

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
