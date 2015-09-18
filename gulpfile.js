var gulp = require('gulp');
var sass = require('gulp-sass');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');


gulp.task('sass', function () {
  gulp.src('sass/styles.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('sass'));
});

gulp.task('sass:watch', function () {
  gulp.watch(['sass/**/*.scss', 'sass/styles.scss'], ['sass', 'cssmin']);
});

gulp.task('cssmin', function(){
	gulp.src('sass/styles.css')
		.pipe(cssmin())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('sass'));	
});

gulp.task('default', ['sass', 'cssmin', 'sass:watch']);