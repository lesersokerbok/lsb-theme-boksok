var gulp         = require('gulp')
var path         = require('path')
var less         = require('gulp-less')
var autoprefixer = require('gulp-autoprefixer')
var sourcemaps   = require('gulp-sourcemaps')
var minifyCSS    = require('gulp-minify-css')
var rename       = require('gulp-rename')
var concat       = require('gulp-concat')
var uglify       = require('gulp-uglify')

var Paths = {
  HERE                 : './',
  DIST                 : 'dist',
  DIST_JS              : 'main.js',
  LESS_SOURCE          : 'assets/less/main.less',
  LESS_WATCH           : 'assets/less/**/**',
  JS_SOURCES           : [
      'node_modules/bootstrap/transition.js',
      'node_modules/bootstrap/alert.js',
      'node_modules/bootstrap/affix.js',
      'node_modules/bootstrap/button.js',
      'node_modules/bootstrap/carousel.js',
      'node_modules/bootstrap/collapse.js',
      'node_modules/bootstrap/dropdown.js',
      'node_modules/bootstrap/modal.js',
      'node_modules/bootstrap/tooltip.js',
      'node_modules/bootstrap/popover.js',
      'node_modules/bootstrap/scrollspy.js',
      'node_modules/bootstrap/tab.js',
      'assets/js/**/**'
    ],
  JS_WATCH             : 'assets/js/*'
}

gulp.task('build', ['less-min', 'js-min']);

gulp.task('dev', ['less', 'js', 'watch']);

gulp.task('watch', function () {
  gulp.watch(Paths.LESS_WATCH, ['less']);
  gulp.watch(Paths.JS_WATCH,   ['js']);
});

gulp.task('less', function () {
  return gulp.src(Paths.LESS_SOURCE)
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(autoprefixer())
    .pipe(sourcemaps.write(Paths.HERE))
    .pipe(gulp.dest(Paths.DIST))
})

gulp.task('less-min', ['less'], function () {
  return gulp.src(Paths.LESS_SOURCE)
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(autoprefixer())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(sourcemaps.write(Paths.HERE))
    .pipe(gulp.dest(Paths.DIST))
})

gulp.task('js', function () {
  return gulp.src(Paths.JS_SOURCES)
    .pipe(concat(Paths.DIST_JS))
    .pipe(gulp.dest(Paths.DIST))
})

gulp.task('js-min', ['js'], function () {
  return gulp.src(Paths.DIST + '/' + Paths.DIST_JS)
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(Paths.DIST))
})
