////// LAUNCH!
////
//


var gulp = require('gulp'),
  sass = require('gulp-sass'),
  criticalcss = require("criticalcss"),
  sourcemaps = require('gulp-sourcemaps'),
  scsslint = require('gulp-scss-lint'),
  watch = require('gulp-watch'),
  gulpLoadPlugins = require("gulp-load-plugins"),
  tasks = gulpLoadPlugins({scope: ["devDependencies"]}),
  gutil = require('gulp-util'),
  cssGlobbing = require('gulp-css-globbing'),
  babel = require('gulp-babel'),
  eslint = require('gulp-eslint'),
  replace = require('gulp-replace'),
  request = require('request'),
  fs = require('fs'),
  del = require('del'),
  //cmq = require('gulp-combine-media-queries'),
  path = require('path'),
  notify = tasks.notify;

function getDevUrl(){
  return `http://${path.resolve('../../..').split("/").reverse()[0]}.dev`;
}
gulp.task('site-name', function(){
  console.log(getDevUrl());
});

gulp.task('dist-sass', function () {
    gulp.src('./assets/src/scss/*.scss')
      .pipe(scsslint({
        'config': 'scss-lint.yml',
      }));
    gulp.src('./assets/src/scss/application.scss')
		//.pipe(tasks.sourcemaps.init())
	    .pipe(tasks.sass())
      .on('error', function(message){
        console.log(message);
      })
	    .pipe(tasks.autoprefixer('last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
      //.pipe(cmq({
        //log: true
      //}))
	    .pipe(gulp.dest('./assets/dist/css'))
      .pipe(tasks.rename({suffix: '.min'}))
      .pipe(tasks.cssmin())
		//.pipe(tasks.sourcemaps.write())
	  .pipe(gulp.dest('./assets/dist/css')).on('end', function(){

    var tmpDir = require('os').tmpdir();
    var cssUrl = './assets/dist/css/application.min.css';
    //var cssPath = path.join( tmpDir, 'style.css' );
    //gulp.src(cssUrl).pipe(fs.createWriteStream(cssPath)).on('close', function() {
      criticalcss.getRules(cssUrl, function(err, output) {
        if (err) {
          console.log(err);
          throw new Error(err);
        } else {
          criticalcss.findCritical(getDevUrl(), { rules: JSON.parse(output) }, function(err, output) {
            if (err) {
              console.log(err);
              throw new Error(err);
            } else {
              console.log(output);
              fs.writeFileSync( './assets/dist/css/critical.css', output );
            }
          });
        }
      });
    //});
    });
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
});

gulp.task('dist-img', function(){
	return gulp.src(['assets/src/img/*.jpg', 'assets/src/img/*.png', 'assets/src/img/*.svg'])
	  .pipe(tasks.newer('assets/dist/img'))
	  .pipe(tasks.imagemin())
	  .pipe(gulp.dest('assets/dist/img'));
});

gulp.task('version-update', function(){
  var date = new Date().toISOString();
  del(['inc/version.php']);
  return gulp.src(['inc/version.tmp.php'])
    .pipe(replace('PACKAGEVERSION', "'"+date+"'"))
    .pipe(tasks.rename({
      basename: 'version',
      extname: '.php'
    }))
    .pipe(gulp.dest('inc/'));
});

gulp.task('watch', function () {
	watch('assets/src/**/*.js', gulp.parallel('dist-js', 'version-update'));
	gulp.watch('assets/src/**/*.scss', gulp.parallel('dist-sass', 'version-update'));
});
