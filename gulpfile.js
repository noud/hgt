var gulp = require('gulp'),
  less = require('gulp-less'),
  browserSync = require('browser-sync').create(),
  sourcemaps = require('gulp-sourcemaps'),
  prefix = require('gulp-autoprefixer'),
  reload = browserSync.reload,
  imagemin = require('gulp-imagemin'),
  imageminMozjpeg = require('imagemin-mozjpeg'),
  runSequence = require('run-sequence'),
  cleanCSS = require('gulp-clean-css'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify');


//var website = {};
//website.domain = 'hgt.ontwikkel.webdesigntilburg.nl'; // Define your domain

var sourceFolder = 'assets/';
var ouputFolder = 'web/assets/';

gulp.task('less', function () {
  return gulp.src(sourceFolder + 'less/main.less')
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(prefix({
      browsers: ['last 2 versions', 'ie 9', 'android 4', 'safari 7']
    }))
    .pipe(sourcemaps.write('../css'))
    .pipe(gulp.dest(ouputFolder + 'css'));
});

gulp.task('minify-css', function () {
  return gulp.src(ouputFolder + 'css/main.css')
    .pipe(cleanCSS({
      level: {
        1: {
          specialComments: 0
        }
      }
    }))
    .pipe(gulp.dest(ouputFolder + 'css'));
});

gulp.task('js', function () {
  return gulp.src([
    sourceFolder + 'js/vendor/lib/jquery.js',
    sourceFolder + 'js/vendor/jquery-ui.js',
    sourceFolder + 'js/vendor/datepicker-nl.js',
    sourceFolder + 'js/vendor/**/*.js',
    sourceFolder + 'js/main.js'
  ])
    .pipe(concat('main.js'))
    .pipe(gulp.dest(ouputFolder + 'js'));
});


gulp.task('compress', function () {
  return gulp.src(ouputFolder + 'js/main.js')
    .pipe(uglify())
    .pipe(gulp.dest(ouputFolder + 'js'));
});

gulp.task('watch', function () {

  // browserSync.init({
  //   proxy: "http://" + website.domain + "/",
  //   host: website.domain,
  //   open: 'external'
  // });

  gulp.watch(sourceFolder + 'less/**/*.less', ['less']);
  gulp.watch(sourceFolder + 'js/**/*.js', ['js']);
  // gulp.watch('app/Resources/views/**/*.html.twig').on("change", reload);
});

gulp.task('optimize-images', function () {
  gulp.src(sourceFolder + 'images/**/*')
    .pipe(imagemin([
      imagemin.gifsicle({interlaced: true}),
      imageminMozjpeg({quality: 80}),
      imagemin.optipng({optimizationLevel: 5}),
      imagemin.svgo({
        plugins: [
          {cleanupIDs: true},
          {removeTitle: true}
        ]
      })
    ]))
    .pipe(gulp.dest(ouputFolder + 'images'));

  gulp.src(sourceFolder + 'svg/*')
    .pipe(imagemin([
      imagemin.svgo({
        plugins: [
          {cleanupIDs: false},
          {removeDimensions: true},
          {removeTitle: true}
        ]
      })
    ]))
    .pipe(gulp.dest(ouputFolder + 'svg'));
});

gulp.task('build', function (callback) {
  runSequence(
    'less',
    'minify-css',
    'js',
    'compress',
    callback
  );
});

gulp.task('default', function (callback) {
  runSequence(
    'less',
    'js',
    callback
  );
});