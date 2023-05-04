'use strict';

// Load Gulp
var gulp = require('gulp');

// Load Sass Functions
var sass = require('gulp-sass')(require('sass'));
var rename = require( 'gulp-rename' );
var autoprefixer = require( 'gulp-autoprefixer' );
var concat = require( 'gulp-concat' )
var sourcemaps = require( 'gulp-sourcemaps' );

gulp.task('css-compile', async function() {
  gulp.src( './assets/src/scss/**/*.scss' )
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
      .pipe( gulp.dest( './assets/dist/css/' ) );
});

gulp.task('watch', function() {
  gulp.watch('./assets/src/scss/**/*.scss', gulp.series('css-compile'));
});