'use strict';

// Load Gulp
var gulp = require('gulp');

// General functions
var concat = require( 'gulp-concat' );
var rename = require( 'gulp-rename' );
var sourcemaps = require( 'gulp-sourcemaps' );

// Load Sass Functions
var sass = require('gulp-sass')(require('sass'));
var autoprefixer = require( 'gulp-autoprefixer' );

// JS Functions
var babelify = require('babelify');
var uglify = require('gulp-uglify');
var buffer = require("vinyl-buffer");
var source = require("vinyl-source-stream");
var browserify = require("browserify");

// Sass task
gulp.task('css-compile', function(done) {
  gulp.src( './src/scss/**/*.scss' )
      .pipe(concat('main.scss'))
      .pipe( sourcemaps.init())
      .pipe( sass({
          errorLogToConsole: true,
          outputStyle: 'compressed'
      }) )
      .on( 'error', console.error.bind( console ) )
      .pipe( autoprefixer({
          overrideBrowserslist: ['last 2 versions'],
          cascade: false
      }) )
      .pipe( rename( { suffix: '.min' } ) )
      .pipe( sourcemaps.write( './' ) )
      .pipe( gulp.dest( './dist/css/' ) );
      done();
});

// JS task
gulp.task('js-compress', function() {
  return browserify({
      entries: ["src/js/main.js"]
  })
  .transform(babelify.configure({
      presets : ["@babel/preset-env" ]
  }))
  .bundle()
  .pipe(source("main.js"))
  .pipe(buffer())
  .pipe(sourcemaps.init())
  .pipe(uglify())
  .pipe(sourcemaps.write('./'))
  .pipe(gulp.dest("./dist/js/"));
});

gulp.task('watch', async function() {
  gulp.watch('./src/scss/**/*.scss', gulp.series('css-compile'));
  gulp.watch('./src/js/**/*.js', gulp.series('js-compress'));
});