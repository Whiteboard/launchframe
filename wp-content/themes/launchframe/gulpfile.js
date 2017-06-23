var gulp = require('gulp'),
    sass = require('gulp-sass'),
    include = require('gulp-include'),
    scsslint = require('gulp-scss-lint'),
    watch = require('gulp-watch'),
    gulpLoadPlugins = require("gulp-load-plugins"),
    tasks = gulpLoadPlugins({scope: ["devDependencies"]}),
    gutil = require('gulp-util'),
    cssGlobbing = require('gulp-css-globbing'),
    babel = require('gulp-babel'),
    eslint = require('gulp-eslint'),
    replace = require('gulp-replace'),
    del = require('del'),
    notify = tasks.notify,
    sass = tasks.sass,
    sourcemaps = require('gulp-sourcemaps');

gulp.task('dist-sass', function() {
    gulp.src('./assets/src/scss/*.scss').pipe(scsslint({'config': 'scss-lint.yml'}));
    gulp.src('./assets/src/scss/application.scss').pipe(sourcemaps.init()).pipe(sass().on('error', sass.logError)).on('error', function(message) {
        console.log(message);
    }).pipe(tasks.autoprefixer('last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4')).pipe(sourcemaps.write()).pipe(gulp.dest('./assets/dist/css')).pipe(tasks.rename({suffix: '.min'})).pipe(tasks.cssmin()).pipe(gulp.dest('./assets/dist/css'));
});

gulp.task('dist-js', function() {

    gulp.src('./assets/src/js/script.js').pipe(tasks.concat('./assets/dist/js/script.js')).pipe(eslint()).pipe(include({
        includePaths: [__dirname + "/assets/vendor"]
    })).pipe(babel()).pipe(gulp.dest('./')).pipe(tasks.rename({suffix: '.min'})).pipe(tasks.uglify()).pipe(eslint.format()).pipe(gulp.dest('./')).on('error', function(message) {
        console.log(message);
    });
});

gulp.task('dist-img', function() {
    return gulp.src(['assets/src/img/*.jpg', 'assets/src/img/*.png', 'assets/src/img/*.svg']).pipe(tasks.newer('assets/dist/img')).pipe(tasks.imagemin()).pipe(gulp.dest('assets/dist/img'));
});

gulp.task('version-update', function() {
    var date = new Date().toISOString();
    del(['inc/version.php']);
    return gulp.src(['inc/version.tmp.php']).pipe(replace('PACKAGEVERSION', "'" + date + "'")).pipe(tasks.rename({basename: 'version', extname: '.php'})).pipe(gulp.dest('inc/'));
});

gulp.task('watch', function() {
    watch('assets/src/**/*.js', function() {
        gulp.start('dist-js');
        gulp.start('version-update');
    });
    watch('assets/src/**/*.scss', function() {
        gulp.start('dist-sass');
        gulp.start('version-update');
        gulp.start('dist-img');
    });
    watch('assets/vendor/**/*.js', function() {
        gulp.start('dist-js');
    });
});
